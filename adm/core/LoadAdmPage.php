<?php
namespace Core;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * LoadAdmPage Responsible for checking whether the page is public or restricted.
 * 
 * @author ACD
 */
class LoadAdmPage
{
 
    private string $urlController;
    private string $urlMethod;
    private string $urlParameter;
    private string $class;
    private array $publicPage;
    private array $restrictedPage;
  
    public function loadPage($urlController = null, $urlMethod = null, $urlParameter = null){
        $this->urlController = $urlController;
        $this->urlMethod = $urlMethod;
        $this->urlParameter = $urlParameter;
        
        $this->publicPage();

        if (class_exists($this->class)) {

            $this->loadMethod();
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMethod = $this->slugMethod(METHOD);
            $this->urlParameter = "";
            $this->class = "\\App\\adms\\Controllers\\" . $this->urlController;
            $this->loadMethod();
        }   
    }    
       
    private function loadMethod() {

        $loadClass = new $this->class();

        if(method_exists($loadClass, $this->urlMethod)){
            
            $loadClass->{$this->urlMethod}($this->urlParameter);
            
        }else{
      
            die("Erro: o método não foi encontrado Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM . "!<br>");
           
        //     $urlDestiny = URLADM . "error/index";
        //     header("Location: $urlDestiny");
        }        
    }

    private function publicPage() {
        $this->publicPage = ["Login", "Error", "Home", "Logout", "NewUser", "ConfEmail", "NewConfEmail", "RecoverPassword", "UpdatePassword"];

        if(in_array($this->urlController, $this->publicPage)) {
            $this->class = "\\App\adms\\Controllers\\" . $this->urlController;
            
        } else {
            
            $this->restrictedPage();
        }
    }

    private function restrictedPage() {
        $this->restrictedPage = ["Dashboard", "ListColors", "ListSitsUsers", "ListUsers", "ListConfEmails", "ViewUser", "ViewColor", "ViewSitsUser", "ViewConfEmail", "EditColor", "EditConfEmail", "EditSitsUser", "EditUser", "AddColor", "AddSitsUser", "AddUser", "AddConfEmail", "EditUserPassword", "EditUserImage", "DeleteUser", "DeleteColor", "DeleteConfEmail", "DeleteSitsUser", "ViewProfile", "EditProfile", "EditProfileImage", "EditProfilePassword", "ListAccessLevels", "ViewAccessLevel", "EditAccessLevel", "AddAccessLevel", "DeleteAccessLevel","EditFormLevel", "ViewFormLevel", "EditConfEmailPassword", "OrderAccessLevel", "ListSitsPages", "AddSitsPages", "ViewSitsPages", "EditSitsPages", "DeleteSitsPages", "ListTypesPages", "AddTypesPages", "ViewTypesPages", "EditTypesPages", "DeleteTypesPages", "OrderTypesPages", "ListGroupsPages", "AddGroupsPages", "ViewGroupsPages", "EditGroupsPages", "DeleteGroupsPages", "OrderGroupsPages", "ListPages", "ViewPages", "AddPages", "EditPages", "DeletePages", "ListPermission", "SyncPagesLevels", "EditPermission", "PdfUser", "PdfUserDetail"];
       
        if(in_array($this->urlController, $this->restrictedPage)) {
        
            $this->checkLogin();
        } else {
           
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Página não encontrada!</div>';
            
            $urlDestiny = URLADM . "login/index";
            header("Location: $urlDestiny");
        }
    }

    private function checkLogin() {
  
        if(isset($_SESSION['user_id']) AND isset($_SESSION['user_name']) AND isset($_SESSION['user_email']) AND isset($_SESSION['adms_access_level_id']) AND isset($_SESSION['order_levels']) ) {
       
            $this->class = "\\App\\adms\\Controllers\\" . $this->urlController;
        } else {
            
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Para acessar a página realize o login!</div>';
            $urlDestiny = URLADM . "login/index";
            header("Location: $urlDestiny");
        }
    }

    private function slugController($slugController) {
        // Convert to lower case
        $this->slugController = strtolower($slugController);
        // Convert to hyphen the blanck space
        $this->slugController = str_replace("-", " ", $this->slugController);
        // Convert the first letter of each word to uppercase
        $this->slugController = ucwords($this->slugController);
        // Remove white space
        $this->slugController = str_replace(" ", "", $this->slugController);

        return $this->slugController;
    }

    private function slugMethod($slugMethod) {
        $this->slugMethod = $this->slugController($slugMethod);
        //Convert the first letter to lowercase
        $this->slugMethod = lcfirst($this->slugMethod);

        return $this->slugMethod;
    }
} 
?>