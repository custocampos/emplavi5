<?php 

session_start();
require_once ("../model/db_connect.php");

$a= !empty($_POST['nome']);
$b= !empty($_POST['email']) || !empty($_POST['tel']);
$ab= $a && $b;

if($ab){



    $nome="";
    $sobrenome="";
    $email="";
    $tel="";
    $tel2="";


    if(isset($_POST['btn-enviar'])) {
        if(isset($_POST['nome'])) {$nome=$_POST['nome'];}
        if(isset($_POST['email'])) {$email=$_POST['email'];}
        if(isset($_POST['tel'])) {$tel=$_POST['tel'];}
        if(isset($_POST['tel2'])) {$tel2=$_POST['tel2'];}
        if(isset($_POST['sobrenome'])) {$sobrenome=$_POST['sobrenome'];}
    
        

        $data=[ "nome"=>$nome,
        "email"=>$email,
        "tel"=>$tel,
        "tel2"=>$tel2,
        "sobrenome"=>$sobrenome
        ];

        $result=(array)json_decode(createContact($data));

        if (!empty($result["result"])){
            $_SESSION['mensagem2']="Cadastrado com sucesso!";
        
            header('location: ../view/empreendimento.php?flag=1&id='.$result["result"]);
        }

        else {
            $_SESSION['mensagem']="Erro ao cadastrar!";
            header('location: ./../index.php');

        }
    };

}else{

    $_SESSION['mensagem']="Preencha o nome com telefone ou email!";
    header('location: ../view/novo.php');

}; 
?>