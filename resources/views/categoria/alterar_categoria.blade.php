
<div class="container-fluid px-4">
    <h1 class="mt-4">Categorias</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listagem</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Pesquisa de categorias
        </div>
            <div class="card-body">

                <div class="row"></div>
                <form method="POST" action="{{route('cat_alt_salva')}}">
                    @csrf
                    <input type="text" name="id" value="{{$categoria->id}}">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="cat_nome" value="{{$categoria->cat_nome}}">
                        <label for="floatingInput">Nome da categoria</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="cat_descricao" value="{{$categoria->cat_descricao}}">
                        <label for="floatingInput">Descrição</label>
                    </div>
                    <div class="row">
                        <div class = "col-md-4">
                            <input type="submit" class="btn btn-sucess" value="Salvar">
                        </div>

                    </div>
                </form>
            </div>
    </div>
</div>
</div>