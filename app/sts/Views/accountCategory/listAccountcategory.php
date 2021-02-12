<?php

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title ">Listagem das Categorias das Contas</h2>
            </div>
        </div>
    </div>
</div>

<div class="jumbotron categoria">

    <div class="container">
        <table class="table table-primary table-striped table-bordered"> 
            <thead class="table-dark">
                <tr>
                    <th class="text-center">ID</th>
                    <th>NOME</th>
                    <th class="text-right">AÇÃO</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    //Ler o array de registro sobre empresa retornado do banco de dados
                    foreach ($this->dados['listAccountCategory'] as $cat){
                        //A função extract é utilizada para extrair o array e imprimir através do nome da chave
                        extract($cat);
                ?>
            <tr>
                <td class="text-center"><?php echo $id; ?></td>
                <td><?php echo $name; ?></td>
                <td class="text-right">
                    <div class="fa-2x">
                        <a href="#" ><i class="fas fa-eye" style="color:green"></i></a>
                        <a href="#" ><i class="fas fa-edit" style="color:brown"></i></a>
                        <a href="#" ><i class="fas fa-trash" style="color:red"></i></a>
                        <a href="#" ><i class="fas fa-print" style="color:blue"></i></a>
                        
                    </div>
                </td>
           </tr>

           <?php
           
              }
            ?>
            </tbody>
        </table>
              <?php echo $this->dados['pagination']; ?>

    </div>


</div>