<?php
session_start();

require_once __DIR__ ."./../model/db_connect.php";

$dealID=$_POST["id"];

if(!empty($_GET["ger"]) && empty($_POST["gerente"])){
    $gerente=$_GET["ger"];
}else{
    $gerente=$_POST["gerente"];
};


if(!empty($_GET["cor"])){
    updateDeal($dealID,$_GET["cor"]);

}else{

    updateDeal($dealID,$_POST["correID"]);
};

$data=array(
    "id"=> rand(),
    "idDeal"=> $dealID,
    "coment"=>$_POST["textarea1"],
    "gerente"=>$gerente,
    "cor1"=>$_POST["corretor"],
    "cor2"=>$_POST["corretor2"],
    "fonte"=>$_POST["fonte"],
    "tipo"=>$_POST["tipo"],
    "rec"=>$_POST["recepcionista"],
);



$result=(array)json_decode(createElement($data));

$idElement=$result["result"];

workStart($idElement);

if(!empty($result["result"])){
    $_SESSION['mensagem2']="Visita Cadastrada com sucesso!";
   
    header('location: ./../index.php');
}

else {
    $_SESSION['mensagem']="Erro ao cadastrar!";
    header('location: ./../index.php');

};



?>
