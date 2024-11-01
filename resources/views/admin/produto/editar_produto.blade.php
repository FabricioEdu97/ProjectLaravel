@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1>Editar Produto</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.salvar_edicao_produto', $produto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nome">Nome do Produto</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $produto->nome) }}" required>
        </div>

        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" name="valor" id="valor" class="form-control" value="{{ old('valor', $produto->valor) }}" required>
        </div>

        <div class="form-group">
            <label for="foto">Foto do Produto</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
            <small>Atual: <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}" width="100"></small>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control">{{ old('descricao', $produto->descricao) }}</textarea>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="form-control">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $categoria->id == $produto->categoria_id ? 'selected' : '' }}>
                        {{ $categoria->categoria }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('admin.produto_admin') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
