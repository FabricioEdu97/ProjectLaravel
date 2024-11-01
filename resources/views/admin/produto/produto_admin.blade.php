@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1>Gerenciar Produtos</h1>

    <!-- Exibir mensagens de sucesso ou erro -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Botão para criar um novo produto -->
    <div class="mb-3">
        <a href="{{ route('admin.criar_produto') }}" class="btn btn-primary">Criar Produto</a>
    </div>

    <!-- Tabela de Produtos -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Foto</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>R$ {{ number_format($produto->valor, 2, ',', '.') }}</td>
                    <td>
                        @if($produto->foto)
                            <img src="{{ asset('storage/' . $produto->foto) }}" alt="Foto do produto" width="50">
                        @endif
                    </td>
                    <td>{{ $produto->descricao }}</td>
                    <td>{{ $produto->categoria->categoria ?? 'N/A' }}</td> <!-- Mostrando o nome da categoria -->
                    <td>{{ $produto->created_at }}</td>
                    <td>{{ $produto->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.editar_produto', $produto->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('admin.excluir_produto', $produto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
