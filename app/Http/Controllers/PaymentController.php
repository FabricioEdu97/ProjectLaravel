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

                // Aqui você apenas salva o pagamento se necessário,
                // mas para a simplicidade, vamos apenas obter os dados para a view
                $paymentId = $arr['id'];
                $totalAmount = $arr['transactions'][0]['amount']['total'];

                return view('payment.success', [
                    'payment_id' => $paymentId,
                    'amount' => $totalAmount,
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

    public function historicoCompras()
    {
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para ver seu histórico de compras.');
        }

        // Pega o id do usuário autenticado
        $usuarioId = Auth::id();

        // Busca os itens comprados pelo usuário
        $itensComprados = ItensPedido::whereHas('pedido', function ($query) use ($usuarioId) {
            $query->where('usuario_id', $usuarioId);
        })->with('produto')->get();

        return view('historico_compras', ['itens' => $itensComprados]);
    }

}
