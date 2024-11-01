@extends('web.navegation')

@section('topheader')
<div class="container">
    <h1>{{ $produto->nome }}</h1>
    <img src="{{ asset($produto->foto) }}" alt="{{ $produto->nome }}" width="250">
    <h4>Preço: R$ {{ $produto->valor }}</h4>
    <p>{{ $produto->descricao }}</p>
    <a href="{{ route('adicionar_carrinho', ['idproduto' => $produto->id]) }}" class="btn btn-primary">
        Adicionar ao Carrinho
    </a>
</div>
@endsection
