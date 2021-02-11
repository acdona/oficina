<?php
namespace App\sts\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Description of StsPagination
 *
 * @author ACD
 */
class StsPagination
{

    private $pag;
    private $limitResult;
    private $offset;
    private $query;
    private $parseString;
    private $resultBd;
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
        $count = new \App\sts\Models\helper\StsRead();
        $count->fullRead($this->query, $this->parseString);
        $this->resultBd = $count->getResult();
        $this->pagInstruction();
    }

    private function pagInstruction() {
        $this->totalPages = ceil($this->resultBd[0]['num_result'] / $this->limitResult);
     
        if ($this->totalPages >= $this->pag) {
            $this->layoutPagination();
        } else {
            header("Location: {$this->link}");
        }
    }

    private function layoutPagination() {
        $this->result = "<ul>";

        $this->result .= "<li><a href='" . $this->link . $this->var . "'>Primeira</a></li>";
        
        for($beforePag = $this->pag - $this->maxLinks; $beforePag <= $this->pag - 1; $beforePag++){
            if($beforePag >= 1){
                $this->result .= "<li><a href='" . $this->link ."/". $beforePag . $this->var . "'>$beforePag</a></li>";
            }
        }             
        
        $this->result .= "<li>" . $this->pag . "</li>";
        
        for($afterPag = $this->pag + 1; $afterPag <= $this->pag + $this->maxLinks; $afterPag++){
            if($afterPag <= $this->totalPages){
                $this->result .= "<li><a href='" . $this->link ."/". $afterPag . $this->var . "'>$afterPag</a></li>"; 
            }
        }
        
        $this->result .= "<li><a href='" . $this->link ."/". $this->totalPages . $this->var . "'>Última</a></li>";

        $this->result .= "</ul>";
    }

}
?>