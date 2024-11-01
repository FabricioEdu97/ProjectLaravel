@extends('admin.layout')

@section('content')

<h1>Lista de Usuários</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="mb-3">
    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">Adicionar Usuário</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Login</th> <!-- Adicionada a coluna Login -->
            <th>Email</th>
            <th>Data de Criação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->nome }}</td>
                <td>{{ $usuario->login }}</td> <!-- Exibindo o login do usuário -->
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
