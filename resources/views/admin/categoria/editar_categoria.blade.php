@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1>Editar Categoria</h1>

    <!-- Exibir mensagens de erro -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário de Edição -->
    <form action="{{ route('admin.salvar_edicao', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="categoria">Nome da Categoria</label>
            <input type="text" name="categoria" id="categoria" class="form-control" value="{{ old('categoria', $categoria->categoria) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('admin.categoria_admin') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
