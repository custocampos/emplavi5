<?php

require_once __DIR__ ."./../model/db_connect.php";
session_start();

$corretores=$_SESSION['corretores'];
$gerentes=$_SESSION['gerentes'];
$idsPcor=$_SESSION['idsCor'];


$nome =(string)$_POST['nome'];



$gerenteSelected=procuraStringID($nome,$gerentes,$corretores);

$idSelected=procuraStringID($nome,$idsPcor,$corretores);


$return_arr[] = array("gerente" => $gerenteSelected, "idcor" => $idSelected);


echo json_encode($return_arr);



?>