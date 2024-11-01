<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electro </title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css')}}" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="{{ url('assets/css/slick.css')}}" />
	<link type="text/css" rel="stylesheet" href="{{ url('assets/css/slick-theme.css')}}" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="{{ url('assets/css/nouislider.min.css')}}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{ url('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

	<!-- Custom stylesheet -->

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ url('assets/css/style.css')}}" />

	<header>
		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-left">
					<li><a href="{{ route('home')}}"><i class="fa fa-home"></i> HOME</a></li> <!-- Ícone de Home -->
					<li><a href="{{ route('index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    {{-- <li><a href="{{ route('historico.compras') }}"><i class="fa fa-history"></i> Historico</a></li> --}}
				</ul>
				<ul class="header-links pull-right">
					<li><a href="{{ route('categoria')}}"><i class="bi bi-box-seam-fill"></i> Produtos </a></li>
					<li><a href="{{ route('cadastrar')}}"><i class="fa fa-user-o"></i> Cadastrar</a></li>
					@if(!Auth::user())
						<li><a href="{{ route('logar')}}"><i class="fa fa-sign-in"></i> Logar</a></li> <!-- Ícone para Logar -->
					@else
						<li><a href="{{ route('sair')}}"><i class="fa fa-sign-out"></i> Logout</a></li> <!-- Ícone para Logout -->
					@endif
				</ul>
			</div>
		</div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="#" class="logo">
                                <img src="{{ url('assets/img/logo.png') }}')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form>
                                <select class="input-select">
                                    <option value="0">All Categories</option>
                                    <option value="1">Category 01</option>
                                    <option value="1">Category 02</option>
                                </select>
                                <input class="input" placeholder="Search here">
                                <button class="search-btn">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">

                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Meu carrinho</span>
                                    <!-- Mostra o número total de itens no carrinho -->
                                    <div class="qty">{{ session('cart') ? count(session('cart')) : 0 }}</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <!-- Itera sobre os produtos adicionados ao carrinho -->
                                        @if(session('cart') && count(session('cart')) > 0)
                                            @foreach(session('cart') as $produto)
                                                <div class="product-widget">
                                                    <div class="product-img">
                                                        <img src="{{ asset('storage/' . $produto->foto) }} " alt="{{ $produto->nome }}">
                                                    </div>
                                                    <div class="product-body">
                                                        <h3 class="product-name">
                                                            <a href="{{ route('detalhes_produto', ['id' => $produto->id]) }}">{{ $produto->nome }}</a>
                                                        </h3>
                                                        <h4 class="product-price"><span class="qty">1x</span> R$ {{ $produto->valor }}</h4>
                                                    </div>
                                                    <form action="{{ route('carrinho_excluir', ['indice' => $loop->index]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="delete"><i class="fa fa-close"></i></button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>Carrinho vazio.</p>
                                        @endif
                                    </div>
                                    <div class="cart-summary">
                                        <small>{{ session('cart') ? count(session('cart')) : 0 }} Item(s) selecionados</small>
                                        <h5>SUBTOTAL: R$ {{ session('cart') ? collect(session('cart'))->sum('valor') : 0 }}</h5>
                                    </div>
                                    <<div class="cart-btns">
                                        <a href="{{ route('ver_carrinho') }}">Ver Carrinho</a>
                                        <!-- Alterado para redirecionar para a rota de pagamento -->
                                        <form method="post" action="{{ route('payment') }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Finalizar <i class="fa fa-arrow-circle-right"></i></button>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>



    @if ($message = Session::get('err'))
        <div class="col-12">
            <div class="alert alert-danger">{{ $message }}

            </div>
        </div>
    @endif
    @if ($message = Session::get('ok'))
        <div class="col-12">
            <div class="alert alert-success">{{ $message }}

            </div>
        </div>
    @endif
    @yield('topheader')
    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p> Sigam <strong>Electro</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Digite seu email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Se inscrevam</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER -->

    <!-- FOOTER -->
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>ITE. Linguagem de programação web 2.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>Vila Falcão</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>14992356988</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>fabricio@ite.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li><a href="#">Hot deals</a></li>
                                <li><a href="#">Laptops</a></li>
                                <li><a href="#">Smartphones</a></li>
                                <li><a href="#">Cameras</a></li>
                                <li><a href="#">Accessories</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This
                            template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                                href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/slick.min.js') }}"></script>
    <script src="{{ url('assets/js/nouislider.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>

    </body>

</html>
