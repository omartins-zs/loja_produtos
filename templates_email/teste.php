<?php


$str_1 = array(
  '{link}' => "http://localhost/infoprodutos/download/?key=",
  '{valor}' => '50,0',
  '{forma}' => 'teste',
  '{nome_cliente}' => 'Luan'
);


  $html = file_get_contents('envia_link.html');

  $cp = $html;

  foreach ($str_1 as $indice => $data) {
    $cp .= str_replace($indice,$data,$cp);
  }


 echo $cp;

?>
