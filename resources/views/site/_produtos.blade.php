@if(isset($lista))
	@foreach(@$lista as $prod)

		<div class="product" style="width: 250px !important">

			<div class="product-img">

				<img src="{{ asset('storage/' . $prod->foto) }} ">
				<div class="product-label">
					<span class="sale">-30%</span>
					<span class="new">NEW</span>
				</div>
			</div>
			<div class="product-body">
				<p class="product-category"></p>
				<h3 class="product-name">
                    <a href="{{ route('detalhes_produto', ['id' => $prod->id]) }}">{{ $prod->nome }}</a>
                </h3>
				<h4 class="product-price"> R$ {{$prod->valor}}</h4>
				<div class="product-rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
				</div>
			</div>

			<div class="add-to-cart">
				<a href="{{route('adicionar_carrinho',['idproduto' => $prod->id])}}" class="add-to-cart-btn">
					<i class="fa fa-shopping-cart"></i> Adicionar item
				</a>
			</div>


		</div>

	@endforeach
@endif

