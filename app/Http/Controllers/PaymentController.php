<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        try {
            // Valor total da compra
            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr = $response->getData();

                // Salvar os dados do pagamento no banco de dados
                $payment = new Payment();
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payments_status = $arr['state'];
                $payment->save();

                // Criar pedido
                if (Auth::check()) {
                    // Confirma que o id do usuário está associado a um registro na tabela `usuarios`
                    $pedido = new Pedido();
                    $pedido->payment_id = $arr['id'];
                    $pedido->usuario_id = Auth::id(); // Pega o id do usuário autenticado
                    $pedido->datapedido = now();
                    $pedido->status = 'Pago';
                    $pedido->save();
                } else {
                    // Se o usuário não estiver autenticado, redirecione para a página de login
                    return redirect()->route('login')->with('error', 'Você precisa estar logado para concluir a compra.');
                }

                // Adicionar itens ao pedido
                $produtosCarrinho = session()->get('cart', []);
                foreach ($produtosCarrinho as $produtoId => $item) {
                    $itemPedido = new ItensPedido();
                    $itemPedido->pedido_id = $pedido->id;
                    $itemPedido->produto_id = $produtoId;
                    $itemPedido->quantidade = $item['quantidade'];
                    $itemPedido->valor = $item['valor'];
                    $itemPedido->dt_item = now();
                    $itemPedido->save();
                }

                // Limpar o carrinho após o pagamento
                session()->forget('cart');

                // Obter os produtos comprados
                $produtosComprados = $this->getProdutosComprados($pedido->id);

                return view('payment.success', [
                    'produtos' => $produtosComprados,
                    'payment_id' => $arr['id'],
                    'amount' => $arr['transactions'][0]['amount']['total'],
                    'status' => $arr['state']
                ]);
            } else {
                return $response->getMessage();
            }
        }
    }

    private function getProdutosComprados($pedidoId)
    {
        $itens = ItensPedido::where('pedido_id', $pedidoId)->with('produto')->get();
        $produtosComprados = [];

        foreach ($itens as $item) {
            $produtosComprados[] = [
                'nome' => $item->produto->nome,
                'valor' => $item->valor,
                'quantidade' => $item->quantidade,
                'foto' => $item->produto->foto,
            ];
        }

        return $produtosComprados;
    }
}
