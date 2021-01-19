<?php

require_once __DIR__ ."./../model/db_connect.php";
session_start();

$a= !empty($_POST['nome']);
$b= !empty($_POST['email']) || !empty($_POST['tel']);
$ab= $a && $b;


if($ab){

    if(isset($_GET["id"])){
        $data=array(
            "id"=>$_GET["id"],
            "nome"=>$_POST["nome"],
            "email"=>$_POST["email"],
            "tel1"=>$_POST["tel"],
            "tel2"=>$_POST["tel2"],
            "sobrenome"=>$_POST["sobrenome"]
        );
        updateContact($data);

        $_SESSION['mensagem2']="Contato atualizado!";
        header('location: ../view/empreendimento.php?id='.$_GET["id"]);
    }else{ 
        
        $_SESSION['mensagem']="Erro ao cadastrar!";
        header('location: ./../index.php');

    };


}else{

    $_SESSION['mensagem']="Preencha o nome com telefone ou email!";
    header('location: ../view/atualizar.php?id='.$_GET["id"]);
};


?>