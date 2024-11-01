@extends('admin.layout')

@section('content')
    <title>Pagamento Concluído</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Se estiver usando Bootstrap ou algum CSS -->
</head>
<body>
    <div class="container">
        <h1>Pagamento Concluído!</h1>
        <p><strong>ID da Transação:</strong> {{ $payment_id }}</p>
        <p><strong>Valor Total:</strong> R$ {{ $amount }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Voltar para a Página Inicial</a>
    </div>
</body>
</html>
@endsection
