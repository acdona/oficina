<?php
 
    
use Dompdf\Dompdf;

if(isset($this->data)){
    $listUsers = $this->data;
    //var_dump($listUsers);
}
$listUsers = '<h1 style="text-align: center;">AMACD - Detalhes do Usuário</h1>';
$listUsers .= '<table border=1 style="text-align: center; width:100%;"';  
$listUsers .= '<thead>';
$listUsers .= '<tr>';
$listUsers .= '<th>ID</th>';
$listUsers .= '<th>Nome</th>';
$listUsers .= '<th>Nickname</th>';
$listUsers .= '<th>E-mail</th>';
$listUsers .= '<th>Nome de Usuário</th>';
$listUsers .= '</thead>';
$listUsers .= '<tbody>';

foreach ($this->data as $listUser) {
    extract($listUser);
    //var_dump($listUser);
    $listUsers .= '<tr><td>'.$id . "</td>";
    $listUsers .= '<td>'.$name . "</td>";
    $listUsers .= '<td>'.$nickname . "</td>";
    $listUsers .= '<td>'.$email . "</td>";
    $listUsers .= '<td>'.$username. "</td></tr>";
}

$listUsers .= '</tbody>';
$listUsers .= '</table';

$dompdf = new Dompdf();
$dompdf->loadHtml($listUsers);
$dompdf->setPaper('A4');

$dompdf->render();
$dompdf->stream("detalhe_usuario.pdf", array("Attachment" => false));
 
?>