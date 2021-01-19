<?php

require_once __DIR__ ."./../model/db_connect.php";

session_start();

$ids=$_SESSION['idPhone'];
$nomes=$_SESSION['phone'];

//session_unset();

$nomeClick =(string)json_decode($_POST['data']);

$idContato=procuraStringID($nomeClick,$ids,$nomes);



$contato=getContact($idContato);
$dado2=(array)json_decode($contato);

$nom=$dado2["result"]-> NAME;
$sonom=$dado2["result"]-> LAST_NAME;
$nomComp=$nom." ".$sonom;

if(isset($dado2["result"]-> PHONE)){

$telContato=$dado2["result"]-> PHONE;
if(isset($telContato[1])){
    $telContato= $telContato[1]-> VALUE;
    }else{
        $telContato= $telContato[0]-> VALUE;
    }

}else{
    $telContato=" ";
}

if(isset($dado2["result"]->EMAIL)){
    $mailContato=$dado2["result"]->EMAIL;
    $mailContato=$mailContato[0]->VALUE;
    }else{$mailContato =" "; }

$return_arr[] = array("id" => $idContato,
                    "username" => $nomComp,
                    "phone" => $telContato,
                    "email" => $mailContato);


echo json_encode($return_arr);



?>