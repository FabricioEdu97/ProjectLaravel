<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Categorias</title>
    <link rel="stylesheet" href="{{ asset('css/styless.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Gerenciamento de Categorias</h1>
        
        <!-- Formulário para adicionar categoria -->
        <div class="add-category">
            <h2>Adicionar Nova Categoria</h2>
            <form id="addCategoryForm">
                <label for="categoryName">Nome da Categoria:</label>
                <input type="text" id="categoryName" placeholder="Digite o nome da categoria" required>
                <button type="submit" class="btn-add">Adicionar</button>
            </form>
        </div>
        
        <!-- Tabela de categorias -->
        <div class="category-table">
            <h2>Lista de Categorias</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $linha)
                        <tr>
                            <td>{{$linha->id}}</td>
                            <td>{{$linha->cat_nome}}</td>
                            <td>
                                <a href='{{route('cat_alterar',["id"=>$linha->id])}}'
                                 class="btn btn-primary">
                                    <li class="fa fa-pencil"></li>
                                </a>
                                
                                |
                                <a href='{{route('cat_excluir',["id"=>$linha->id])}}'
                                 class="btn btn-danger">
                                    <li class="fa fa-trash"></li>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para edição de categoria -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Editar Categoria</h2>
            <form id="editCategoryForm">
                <label for="editCategoryName">Nome da Categoria:</label>
                <input type="text" id="editCategoryName" required>
                <button type="submit" class="btn-save">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
