<?php
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProdutoController;

// Rotas públicas
Route::match(['get', 'post'], '/', [ProdutoController::class, 'index'])->name('home');
Route::match(['get', 'post'], '/categoria', [ProdutoController::class, 'categoria'])->name('categoria');
Route::match(['get', 'post'], '/{idcategoria}/categoria', [ProdutoController::class, 'categoria'])->name('categoria_por_id');
Route::match(['get', 'post'], '/cadastrar', [ClienteController::class, 'cadastrar'])->name('cadastrar');
Route::match(['get', 'post'], '/cliente/cadastrar', [ClienteController::class, 'cadastrarCliente'])->name('cadastrar_cliente');
Route::match(['get', 'post'], '/logar', [UsuarioController::class, 'logar'])->name('logar');
Route::get('/sair', [UsuarioController::class, 'sair'])->name('sair');

// Rotas do carrinho protegidas por autenticação
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
