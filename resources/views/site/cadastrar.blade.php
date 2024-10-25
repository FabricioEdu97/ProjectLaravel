@extends("web/navegation")
@section("topheader")


    <h2>Cadastrar cliente</h2>

    <form action="{{route('cadastrar_cliente')}}" method="post">
        @csrf
        <div class="form-group">
            Nome: <input type="text" name="nome" class="form-control"/>
        </div>

        <div class="form-group">
            Email: <input type="email" name="email" class="form-control"/>
        </div>

        <div class="form-group">
            CPF: <input type="text" name="cpf" id="cpf" class="form-control"/>
        </div>

        <div class="form-group">
            Senha: <input type="password" name="password" class="form-control"/>
        </div>

        <div class="form-group">
            Endereço: <input type="text" name="endereco" class="form-control"/>
        </div>
        
        <div class="form-group">
            Numero: <input type="text" name="numero" class="form-control"/>
        </div>

        <div class="form-group">
            Complemento: <input type="text" name="complemento" class="form-control"/>
        </div>
         
        <div class="form-group">
            Cidade: <input type="text" name="cidade" class="form-control"/>
        </div>

        <div class="form-group">
            CEP: <input type="text" name="cep" id="cep" class="form-control"/>
        </div>

        <div class="form-group">
            Estado: <input type="text" name="estado" class="form-control"/>
        </div>

        <input type="submit" value="Cadastrar" class="btn btn-success btn-sm">
    </form>

@endsection