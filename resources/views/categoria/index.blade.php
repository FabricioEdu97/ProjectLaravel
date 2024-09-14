@extends("admin_layout.index")

@section("conteudo")

    <?php
    
   foreach($cat as $linha)
   {
    echo "<p>" . $linha->cat_nome."-" . $linha->id . "</p>";
   }

    ?>

@endsection