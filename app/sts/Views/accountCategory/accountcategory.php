<?php

if(!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>

<div class="jumbotron head-categoria">
    <div class="container">
        <h1 class="text-center">Categorias</h1>
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
                    foreach ($this->dados['viewCategory'] as $account_cat){
                        //A função extract é utilizada para extrair o array e imprimir através do nome da chave
                        extract($account_cat);
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

        <nav aria-label="paginacao">
                            <ul class="pagination pagination-sm justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Primeira</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Última</a>
                                </li>
                            </ul>
                        </nav>



              <p><?php echo $this->dados['pagination']; ?></p>

    </div>


</div>


