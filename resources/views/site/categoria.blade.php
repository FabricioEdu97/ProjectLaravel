@extends("web/navegation")
@section("topheader")
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="{{ route('home') }}">Home</a></li>
                <!-- Dinamicamente lista as categorias -->
                @if(isset($listaCategoria) && count($listaCategoria) > 0)
                    @foreach($listaCategoria as $cat)
                        <li>
                            <a href="{{ route('categoria_por_id', ['idcategoria' => $cat->id]) }}"
                               class="@if(isset($idcategoria) && $cat->id === $idcategoria) active @endif">
                                {{ $cat->categoria }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>

<!-- Listagem de produtos -->
<div style="display: flex; flex-wrap: wrap; gap: 10px">
    @include("site/_produtos", ['lista' => $lista])
</div>
@endsection
