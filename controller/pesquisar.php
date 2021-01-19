<?php

require_once __DIR__ ."./../model/db_connect.php";

$idCon=$_POST["id"];
$emp=$_POST["empreendimento"];
$flag=$_POST["flag"];

if(empty($emp)){
    session_start();
    $_SESSION['mensagem']="Preencha o empreendimento!";
    header('location: ../view/empreendimento.php?id='.$idCon);

}else{

    $result=(array)json_decode(getFields("UF_CRM_1604688211"));
    $result=$result["result"][0];
    $result=$result->LIST;
    $empreendimento=[];


    foreach($result as $data){
        $empreendimento[$data->ID]=$data->VALUE;
        
    }

    $nameImp=$empreendimento[$emp];

    $result=(array)json_decode(getDeal($idCon,$emp));
    $result=(array)$result["result"];

    

    if(isset($result[0]->ID)){

    $dealID= $result[0]->ID;

        }else{

            $result=(array)json_decode(getDeal($idCon,$emp));
            $result=(array)$result["result"];

            if(isset($result[0]->ID)){

                $dealID= $result[0]->ID;
            
                }else{
                    if($flag == 0){
                    $criar=(array)json_decode(createDeal($nameImp,$idCon,$emp));
                    $dealID=$criar["result"];
                        }else{
                            $criar=(array)json_decode(createDeal2($nameImp,$idCon,$emp));
                            $dealID=$criar["result"];
                        };
                };
        };
    header('location: ../view/visita.php?id='.$dealID);
    };
?>