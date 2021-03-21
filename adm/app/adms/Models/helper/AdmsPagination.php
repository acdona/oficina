<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Description of AdmsPagination
 *
 * @author ACD
 */
class AdmsPagination
{

    private $pag;
    private $limitResult;
    private $offset;
    private $query;
    private $parseString;
    private $databaseResult;
    private $result;
    private $totalPages;
    private $maxLinks = 2;
    private $link;
    private $var;

    function getOffset() {
        return $this->offset;
    }

    function getResult() {
        return $this->result;
    }

    function __construct($link, $var = null) {
        $this->link = $link;
        $this->var = $var;
    }

    public function condition($pag, $limitResult) {
        $this->pag = (int) $pag ? $pag : 1;
        $this->limitResult = (int) $limitResult;
        $this->offset = ($this->pag * $this->limitResult) - $this->limitResult;
    }

    public function pagination($query, $parseString = null) {
        $this->query = (string) $query;
        $this->parseString = (string) $parseString;
        $count = new \App\adms\Models\helper\AdmsRead();
        $count->fullRead($this->query, $this->parseString);
        $this->databaseResult = $count->getReadingResult();
        $this->pagInstruction();
    }

    private function pagInstruction() {
        $this->totalPages = ceil($this->databaseResult[0]['num_result'] / $this->limitResult);
     
        if ($this->totalPages >= $this->pag) {
            $this->layoutPagination();
        } else {
            header("Location: {$this->link}");
        }
    }

    private function layoutPagination() {
        $this->result = "<nav aria-label='paginacao'>";
        $this->result .= "<ul class='pagination pagination-sm justify-content-center'>";

        $firstDis = "";
        if($this->pag == 1){
            $firstDis = " disabled";
        }


        $this->result .= "<li class='page-item $firstDis'><a href='" . $this->link . $this->var . "' class='page-link'>Primeira</a></li>";
        
     
    
        
        for($beforePag = $this->pag - $this->maxLinks; $beforePag <= $this->pag - 1; $beforePag++){
            if($beforePag >= 1){
                $this->result .= "<li class='page-item'><a class='page-link' href='" . $this->link ."/". $beforePag . $this->var . "'>$beforePag</a></li>";
        
            }
        }             
        
        $this->result .= "<li class='page-item active'><a href='#' class='page-link'>" . $this->pag . "</a></li>";
       
       
        
        for($afterPag = $this->pag + 1; $afterPag <= $this->pag + $this->maxLinks; $afterPag++){
            if($afterPag <= $this->totalPages){
                $this->result .= "<li li class='page-item'><a class='page-link' href='" . $this->link ."/". $afterPag . $this->var . "'>$afterPag</a></li>"; 
            }
        }
        
        $lastDis = "";
        if($this->pag == $this->totalPages){
            $lastDis = " disabled";
        }
                $this->result .= "<li class='page-item $lastDis'><a class='page-link' href='" . $this->link ."/". $this->totalPages . $this->var . "'>Última</a></li>";
        
        

        $this->result .= "</ul>";

        $this->result .= "</nav>";
    }

}
?>