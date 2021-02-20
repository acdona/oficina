<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
    //Ler o registro da página erro retornado do banco de dados
    //A função extract é utilizada para extrair o array e imprimir através do nome da chave
    extract($this->dados['error']);
    $imagem_error = URL . "app/sts/assets/images/home_error/" . $image_error;   
?>
<div class="content p-1 head-error">
    <div class="container">
        <h1 class="text-center"><?php  echo $title_error; ?></h1>
    </div>            


<div class="p2 error" >
    <div class="container">
        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading"><?php echo $description; ?></h2>             
            </div>
            <div class="col-md-5 order-md-1">
                <img src="<?php echo $imagem_error ?>" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" alt="<?php echo $title_error; ?>">
            </div>
        </div>
    </div>
</div>
</div>
