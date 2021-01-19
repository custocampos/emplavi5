<?php

session_start();

if(empty($_POST['nome']) && empty($_POST['email']) && empty($_POST['telefone'])){
    $_SESSION['mensagem']="Preencha ao menos um campo!";
   
    header('location: ./../index.php');
}else{

    $_SESSION['dados']=[$_POST['nome'],$_POST['email'],$_POST['telefone']];

    header('location: ../view/novo.php');

    };

?>