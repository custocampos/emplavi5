<?php 



include_once __DIR__ ."/header.php";

require_once __DIR__ ."./../model/db_connect.php";

include_once __DIR__ . "/message.php";

$idDeal=$_GET["id"];
$resultEle=(array)json_decode(getElement($idDeal));



if(!empty($resultEle["result"])){
    foreach($resultEle["result"] as $data){
        $b=(array)$data->PROPERTY_284;
        foreach($b as $data2){
            $corretorAnt=$data2;
        };
    };
}else{
    $corretorAnt="";
};

$gerenteAnt="";




$departs=(array)json_decode(listDepart());
$departs=$departs["result"];
$gerentes=[];
$idsDeparts=[];

foreach($departs as $data){
  array_push($gerentes,$data->NAME);
  array_push($idsDeparts,$data->ID);
};

$a=0;
$corretores=[];
$gerentePCor=[];
$idsPcor=[];

foreach($idsDeparts as $data){
  $people=(array)json_decode(listUserDepart($data));
  $people=$people["result"];

  foreach($people as $data2){
    array_push($corretores,$data2->NAME." ".$data2->LAST_NAME);
    array_push($gerentePCor,$gerentes[$a]);
    array_push($idsPcor,$data2->ID);
    if($data2->NAME." ".$data2->LAST_NAME == $corretorAnt){
        $gerenteAnt=$gerentes[$a];
    };
  };

  $a=$a+1;
};

if(!empty($corretorAnt)){
    $idSelected=procuraStringID($corretorAnt,$idsPcor,$corretores);
}else{
    $idSelected="";
};



$_SESSION['gerentes']=$gerentePCor;
$_SESSION['corretores']=$corretores;
$_SESSION['idsCor']=$idsPcor;

$result=(array)json_decode(getFields("UF_CRM_1604688501"));
$result=$result["result"][0];
$result=$result->LIST;
$visitaTipo=[];

foreach($result as $data){
    array_push($visitaTipo, $data->VALUE);
}



?>


<nav>
    <div class="nav-wrapper indigo lighten-5">
        <h4 class="brand-logo center black-text">Informações da visita</h4>
        <h6 href="#" class="brand-logo right"><img src='logotipo_emplavi-2.png' width='263' height='48' /></h6>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="./../index.php"><i class="material-icons left">home</i>Voltar para a tela inicial</a></li>
    </div>
</nav>


<div class="row">
    <div class="col s12 m6 push-m3">
        <div class="card indigo lighten-5">
            <div class="card-content">
                <form class="container" action="../controller/finalizar.php?ger=<?php echo $gerenteAnt;?>&cor=<?php echo $idSelected;?>" method="POST">

                    <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
                    <div class="row">




                        <div class="input-field col s12">
                            <select name="tipo" id="tipo">
                                <option value="Tipo de visita" disabled selected> </option>
                                <?php                                             
                                
                                foreach($visitaTipo as $data){

                                    ?>

                                <option value="<?php echo $data;?>"><?php echo $data;?></option>

                                <?php };
                                
                                
                                
                                ?>

                            </select>
                            <label>Tipo de visita</label>
                        </div>

                        <div class="input-field col s12">
                            <select name="fonte" id="fonte">
                                <option value="Fonte" disabled selected> </option>
                                <option value="Portal de clientes">Portal de clientes</option>
                                <option value="Formulário de CRM">Formulário de CRM</option>
                                <option value="Retorno de Chamada">Retorno de Chamada</option>
                                <option value="Incentivo de vendas">Incentivo de vendas</option>
                                <option value="Mega">Mega</option>
                                <option value="123Imoveis">123Imoveis</option>
                                <option value="Atendimento Online">Atendimento Online</option>
                                <option value="Boxtrus">Boxtrus</option>
                                <option value="Captação Correntor">Captação Correntor</option>
                                <option value="Carteira Emplavi/ Indicação">Carteira Emplavi/ Indicação</option>
                                <option value="Carteira Corretor">Carteira Corretor</option>
                                <option value="Convite Evento">Convite Evento</option>
                                <option value="E-mail Mkt">E-mail Mkt</option>
                                <option value="Central de vendas">Central de vendas</option>
                                <option value="Empreendimento pronto">Empreendimento pronto</option>
                                <option value="E-mail Pós venda">E-mail Pós venda</option>
                                <option value="Evento Emplavi day">Evento Emplavi day</option>
                                <option value="Facebook Leads Ads">Facebook Leads Ads</option>
                                <option value="Google">Google</option>
                                <option value="Indicação">Indicação</option>
                                <option value="Google Cpc">Google Cpc</option>
                                <option value="Imovelweb">Imovelweb</option>
                                <option value="Importação oferta ativa">Importação oferta ativa</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Morador do noroeste">Morador do noroeste</option>
                                <option value="Outdoor">Outdoor</option>
                                <option value="Parceria">Parceria</option>
                                <option value="Site institucional">Site institucional</option>
                                <option value="Stand de vendas">Stand de vendas</option>
                                <option value="Stand Móvel">Stand Móvel</option>
                                <option value="Stand Shopping Iguatemi">Stand Shopping Iguatemi</option>
                                <option value="Tapume de obra">Tapume de obra</option>
                                <option value="Telefone">Telefone</option>
                                <option value="VivaReal">VivaReal</option>
                                <option value="Whatsapp">Whatsapp</option>
                                <option value="Wimoveis">Wimoveis</option>
                                <option value="Zap">Zap</option>
                                <option value="Automação Formulário">Automação Formulário</option>
                                <option value="Chat">Chat</option>
                                <option value="Planilha manutenção">Planilha manutenção</option>


                            </select>
                            <label>Fonte</label>
                        </div>



                        <div class="input-field col s12">
                            <select name="corretor" id="corretor">
                                <option value="corretor" disabled selected> </option>

                                <?php                                             
                                
                                foreach($corretores as $data){

                                    if($data == $corretorAnt){
                                        ?>
                                        

                                        <option value="<?php echo $data;?>" selected ><?php echo $data;?> - Gerente: <?php echo $gerenteAnt;?></option>

                                        <?php

                                    }else{

                                    ?>

                                <option value="<?php echo $data;?>"><?php echo $data;?></option>

                                <?php }};
                                
                                
                                
                                ?>



                            </select>
                            <label>Corretor</label>

                        </div>

                        <div class="input-field col s12" id="gerenteDiv">
                        
                        </div>

                        <div class="input-field col s12">
                            <input type="hidden" name="gerente" id="gerente" />
                        </div>

                        <div class="input-field col s12">
                            <input type="hidden" name="correID" id="correID" />
                        </div>

                        <div class="input-field col s12">
                            <input type="text" name="corretor2" id="corretor2" />
                            <label for="corretor2">Corretor responsável 2</label>
                        </div>

                        <div class="input-field col s12">
                            <input type="text" name="recepcionista" id="recepcionista" />
                            <label for="recepcionista">Recepcionista</label>
                        </div>


                        <div class="input-field col s12">


                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea name="textarea1" id="textarea1" class="materialize-textarea"></textarea>
                                    <label for="textarea1">Comentários sobre a visita</label>
                                </div>
                            </div>

                        </div>

                        <div class="input-field col s12">
                            <button type="submit" class="btn-large indigo darken-4" name="btn-enviar">Cadastrar visita<i
                                    class="material-icons right">send</i></button>
                        </div>

                    </div>






            </div>
            </form>


        </div>

    </div>
</div>
</div>



<script>
    $(document).ready(function () {
        $('select#corretor').change(function () {
            var optionSelected = $(this).find("option:selected");
            //var valueSelected  = $(this.result).find("option:selected");
            var corretor_name = optionSelected.text();
            var sdata = {nome : corretor_name}
        

            $.ajax({
                url: '../controller/recebe4.php',
                type: 'POST',
                data: sdata,
                success: function (result) {
                    // Retorno se tudo ocorreu normalmente
                    var response = $.parseJSON(result);

                    var htmlStru = "<p>Gerente: " + response[0].gerente +  "</p>" ;


                    $('#gerenteDiv').html(htmlStru);
                    $("#gerente").val(response[0].gerente);
                    $("#correID").val(response[0].idcor);
                    //$("#idCon").val(response[0].id);
                    //document.getElementById("gerenteDiv").innerHTML=htmlStru;
                    // document.getElementById("idCon").value=response[0].id;

                    //$('#modal').modal('open');
                },

            });
        });
    });
</script>

<?php 

include_once __DIR__ ."/footer.php";
?>