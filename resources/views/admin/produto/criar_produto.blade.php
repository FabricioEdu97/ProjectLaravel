@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1>Adicionar Novo Produto</h1>

    <form action="{{ route('admin.adicionar_produto') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nome">Nome do Produto</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" name="valor" id="valor" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="foto">Foto do Produto</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="form-control">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Adicionar Produto</button>
    </form>
</div>
@endsection
