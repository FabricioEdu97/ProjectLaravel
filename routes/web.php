    <?php
    use App\Http\Controllers\ClienteController;
    use App\Http\Controllers\PaymentController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UsuarioController;
    use App\Http\Controllers\ProdutoController;
    use App\Http\Controllers\AdminCategoriaController;
    use App\Http\Controllers\AdminProdutoController;
    use App\Http\Controllers\AdminAuthController;
    use App\Http\Controllers\AdminUsuarioController;
    use App\Http\Controllers\CompraController;

    use App\Http\Controllers\PurchaseHistoryController;


    Route::match(['get', 'post'], '/', [ProdutoController::class, 'index'])->name('home');
    Route::match(['get', 'post'], '/categoria', [ProdutoController::class, 'categoria'])->name('categoria');
    Route::match(['get', 'post'], '/{idcategoria}/categoria', [ProdutoController::class, 'categoria'])->name('categoria_por_id');
    Route::match(['get', 'post'], '/cadastrar', [ClienteController::class, 'cadastrar'])->name('cadastrar');
    Route::match(['get', 'post'], '/cliente/cadastrar', [ClienteController::class, 'cadastrarCliente'])->name('cadastrar_cliente');
    Route::match(['get', 'post'], '/logar', [UsuarioController::class, 'logar'])->name('logar');
    Route::get('/produto/{id}', [ProdutoController::class, 'detalhesProduto'])->name('detalhes_produto');
    Route::get('/produtos-mais-vendidos', [ProdutoController::class, 'produtosMaisVendidos']);


    Route::get('/sair', [UsuarioController::class, 'sair'])->name('sair');



    Route::prefix('admin/categorias')->group(function () {
        Route::get('/', [AdminCategoriaController::class, 'listarCategorias'])->name('admin.categoria_admin');
        Route::post('/', [AdminCategoriaController::class, 'adicionarCategoria'])->name('admin.adicionar_categoria');
        Route::get('/editar/{id}', [AdminCategoriaController::class, 'editarCategoria'])->name('admin.editar_categoria');
        Route::put('/editar/{id}', [AdminCategoriaController::class, 'salvarEdicao'])->name('admin.salvar_edicao');
        Route::delete('/excluir/{id}', [AdminCategoriaController::class, 'excluirCategoria'])->name('admin.excluir_categoria');
    });


    Route::prefix('admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'login']);

        Route::middleware('auth:admin')->group(function () {
            Route::get('dashboard', [AdminCategoriaController::class, 'index'])->name('index');
            Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        });

    });



    Route::prefix('admin/produtos')->group(function () {
        Route::get('/', [AdminProdutoController::class, 'listarProdutos'])->name('admin.produto_admin');
        Route::get('/criar', [AdminProdutoController::class, 'criarProduto'])->name('admin.criar_produto'); // Adicionando rota para criar produto
        Route::post('/', [AdminProdutoController::class, 'adicionarProduto'])->name('admin.adicionar_produto');
        Route::get('/editar/{id}', [AdminProdutoController::class, 'editarProduto'])->name('admin.editar_produto');
        Route::put('/editar/{id}', [AdminProdutoController::class, 'salvarEdicao'])->name('admin.salvar_edicao_produto');
        Route::delete('/excluir/{id}', [AdminProdutoController::class, 'excluirProduto'])->name('admin.excluir_produto');
    });



    Route::get('admin/usuarios', [AdminUsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::get('admin/usuarios/create', [AdminUsuarioController::class, 'create'])->name('admin.usuarios.create');
    Route::post('admin/usuarios', [AdminUsuarioController::class, 'store'])->name('admin.usuarios.store');
    Route::get('admin/usuarios/{id}/edit', [AdminUsuarioController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('admin/usuarios/{id}', [AdminUsuarioController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('admin/usuarios/{id}', [AdminUsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');




    Route::get('/historico-compras', [PurchaseHistoryController::class, 'historicoCompras'])->name('historico.compras');
    Route::post('/comprar', [CompraController::class, 'processarCompra'])->name('comprar');


    Route::post('pay',[PaymentController::class, 'pay'])->name('payment');
    Route::get('success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('error', [PaymentController::class, 'error'])->name('payment.error');


    Route::middleware('auth')->group(function () {
        Route::match(['get', 'post'], '/{idproduto}/carrinho/adicionar', [ProdutoController::class, 'adicionarCarrinho'])->name('adicionar_carrinho');
        Route::match(['get', 'post'], '/carrinho', [ProdutoController::class, 'verCarrinho'])->name('ver_carrinho');
        Route::match(['get', 'post'], '/{indice}/excluircarrinho', [ProdutoController::class, 'excluirCarrinho'])->name('carrinho_excluir');
        Route::post('carrinho/finalizar', [ProdutoController::class, 'finalizar'])->name('carrinho_finalizar');
    });




























    // Route::get("/categoria/upd/{id}", [CategoriaController::class, 'BuscaAlterar'])->name('cat_alterar');
    // Route::post("/categoria/udp", [CategoriaController::class, "SalvarAlteracao"])->name('cat_alt_salva');


    // Route::get("/categoria/exc/{id}", [CategoriaController::class, 'ExcluirCategoria'])->name('cat_excluir');





















    // Route::get('/', function () {
    //     return view('index');
    // });

    // Route::match(['get', 'post'], '/',[ProdutoController::class, 'home'])
    //     ->name('home'); ANT

    // Route::get('/', [HomeController::class, 'home']);

    // Route::match(['get', 'post'], '/categoria',[ProdutoController::class, 'categoria']) ANT
    //    ->name('categoria');
    // Route::match(['get', 'post'], '/cadastrar',[ClienteController::class, 'cadastrar']) ANT
    //    ->name('cadastrar');


    // Route::get('/blank', function () {
    //     return view( 'blank');
    // })->name('blank');

    // Route::get('/section', function () {
    //     return view( 'section');
    // })->name('section');


    // Route::get('/buttons', function () {
    //     return view('buttons');
    // })->name('buttons');

    // Route::get('/cards', function () {
    //     return view( 'cards');
    // })->name('cards');

    // Route::get('/charts', function () {
    //     return view( 'charts');
    // })->name('charts');

    // // Route::get('/', function () {
    // //     return view('index');
    // // })->name('index');

    // Route::get('/error', function () {
    //     return view('404');
    // })->name('error');

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth','verified'])->name('dashboard');














    // Route::get('/categoria', [CategoriaController::class, 'index'] )->name("categoria");



    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');

    // Route::middleware('auth')->group(function () {
    //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });

    // require __DIR__.'/auth.php';
