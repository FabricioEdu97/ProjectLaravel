@extends("layout")
@section("conteudo")
	@include("site/_produtos",[ 'lista' => $lista])

@endsection
