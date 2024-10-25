@extends("web/navegation")
@section("topheader")
    @if(isset($listaCategoria) && count($listaCategoria)>0)
        <ul>
            <li><a href="{{route('categoria')}}"class="list-group-item list-group-item-action">Todas</a></li>
            @foreach($listaCategoria as $cat)
                <li><a href="{{route('categoria_por_id',['idcategoria' =>$cat->id])}}"
                class="list-group-item list-group-item-action @if($cat->id === $idcategoria)active @endif">
                {{$cat->categoria}}</a>
            @endforeach    
        </ul>
    @endif
    <div style="display: flex; flex-wrap: wrap; gap: 10px">
        @include("site/_produtos",[ 'lista' => $lista])
    </div>
@endsection