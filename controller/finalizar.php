<?php
session_start();
require_once __DIR__ ."./../model/db_connect.php";


$result=(array)json_decode(getUser($id));
$result=(array)$result["result"];
$name=$result["NAME"];


if(!empty($result["LAST_NAME"])){
$sobrenome=$result["LAST_NAME"];
}else{
$sobrenome="";
};

require_once __DIR__ ."./../model/db_connect.php";

$dealID=$_POST["id"];

if(!empty($_GET["ger"]) && empty($_POST["gerente"])){
    $gerente=$_GET["ger"];
}else{
    $gerente=$_POST["gerente"];
};


if(!empty($_GET["cor"])){
    $result=(array)json_decode(getUser($_GET["cor"]));
    $result=(array)$result["result"];
    $name=$result["NAME"];


    if(!empty($result["LAST_NAME"])){
        $sobrenome=$result["LAST_NAME"];
        updateDeal($dealID,$name." ".$sobrenome);
            }else{
                updateDeal($dealID,$name);
            };
    

            

}else{

    $result=(array)json_decode(getUser($_POST["correID"]));
    $result=(array)$result["result"];
    $name=$result["NAME"];


    if(!empty($result["LAST_NAME"])){
        $sobrenome=$result["LAST_NAME"];
        updateDeal($dealID,$name." ".$sobrenome);
            }else{
                updateDeal($dealID,$name);
            };
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



$result2=(array)json_decode(createElement($data));

$idElement=$result2["result"];

workStart($idElement);

if(!empty($result2["result"])){
    $_SESSION['mensagem2']="Visita Cadastrada com sucesso!";
   
    header('location: ./../index.php');
}

else {
    $_SESSION['mensagem']="Erro ao cadastrar!";
    header('location: ./../index.php');

};



?>
