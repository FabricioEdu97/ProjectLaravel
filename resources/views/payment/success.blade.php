@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Pagamento Concluído</h1>
    <p>ID da Transação: {{ $payment_id }}</p>
    <p>Valor Total: {{ $amount }} {{ env('PAYPAL_CURRENCY') }}</p>
    <p>Status: {{ $status }}</p>

    <h2>Produtos Comprados</h2>
    <ul>
        @foreach ($produtos as $produto)
            <li>
                <img src="{{ asset('storage/' . $produto['foto']) }}" alt="{{ $produto['nome'] }}" style="width: 100px;">
                <p>Nome: {{ $produto['nome'] }}</p>
                <p>Valor: {{ $produto['valor'] }}</p>
                <p>Quantidade: {{ $produto['quantidade'] }}</p>
            </li>
        @endforeach
    </ul>
</div>
@endsection
