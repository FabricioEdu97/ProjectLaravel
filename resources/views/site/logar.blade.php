@extends("web.navegation")
@section("topheader")

<div class="col-md-6 offset-md-3 mt-5">
    <div class="card shadow-lg">

            <h3 class="mb-0">Login</h3>

        <div class="card-body p-4">
            <form action="{{ route('logar') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="login" class="form-label">Login:</label>
                    <input type="text" name="login" class="form-control" placeholder="Digite seu login" required>
                </div>

                <div class="form-group mb-4">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-lg btn-primary">Logar</button>
                    <a href="{{ route('cadastrar') }}" class="btn btn-outline-secondary">Cadastrar-se</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
