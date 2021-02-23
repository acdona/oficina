<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
 
    echo "<h3>Perfil</h3>";
 
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
   
    if(!empty($this->dados['perfil'])) {
        extract($this->dados['perfil'][0]);   
        if(!empty($image_user)  AND (file_exists("app/adms/assets/images/users/" . $_SESSION['user_id'] . "/$image_user"))) {
            echo "<img src='" . URLADM . "app/adms/assets/images/users/" . $_SESSION['user_id'] . "/$image_user' width='100' height='100'><br><br>" ;
        } else {
            echo "<img src='" . URLADM . "app/adms/assets/images/users/icon_user.png' width='100' height='100'><br><br>" ;
        }
        
        echo "Nome: " . $name . "<br>";
        echo "Apelido: " . $nickname . "<br>";
        echo "E-mail: " . $email . "<br>";
        echo "Usuário: " . $username . "<br><br>";
        echo "<a href='" . URLADM ."edit-perfil/index'>Editar Perfil</a><br>";
        echo "<a href='" . URLADM ."edit-perfil-password/index'>Editar Senha</a><br>";
        echo "<a href='" . URLADM ."edit-perfil-image/index'>Editar Imagem</a>";
    }
?>