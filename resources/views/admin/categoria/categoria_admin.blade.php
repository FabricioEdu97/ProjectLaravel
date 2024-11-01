@extends('admin.layout')



@section('content')


<div class="container mt-5">
    <h1>Gerenciar Categorias</h1>

    <!-- Exibir mensagens de sucesso ou erro -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabela de Categorias -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Categoria</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->categoria }}</td>
                    <td>{{ $categoria->created_at }}</td>
                    <td>{{ $categoria->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.editar_categoria', $categoria->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('admin.excluir_categoria', $categoria->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE') <!-- Isso indicará que é uma requisição DELETE -->
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">Excluir</button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Formulário para Adicionar Nova Categoria -->
    <div class="mt-4">
        <h3>Adicionar Nova Categoria</h3>
        <form action="{{ route('admin.adicionar_categoria') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="categoria">Nome da Categoria</label>
                <input type="text" name="categoria" id="categoria" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Adicionar Categoria</button>
        </form>
    </div>
</div>
@endsection
