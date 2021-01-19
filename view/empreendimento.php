<?php 


include_once __DIR__ ."/header.php";

require_once __DIR__ ."./../model/db_connect.php";

include_once __DIR__ . "/message.php";

$result=(array)json_decode(getFields("UF_CRM_1604688211"));
$result=$result["result"][0];
$result=$result->LIST;
$empreendimento=[];


foreach($result as $data){
    $empreendimento[$data->ID]=$data->VALUE;
    
}


if(isset($_GET["flag"])){
    $flag=1;
    }else{
        $flag=0;   
    };

?>


<nav>
    <div class="nav-wrapper indigo lighten-5">
        <h4 class="brand-logo center black-text">Empreendimento</h4>
        <h6 href="#" class="brand-logo right"><img src='logotipo_emplavi-2.png' width='263' height='48' /></h6>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="./../index.php"><i class="material-icons left">home</i>Voltar para a tela inicial</a></li>
    </div>
</nav>


<div class="row">
    <div class="col s12 m6 push-m3">
        <div class="card indigo lighten-5">
            <div class="card-content">
                <form class="container" action="../controller/pesquisar.php" method="POST">

                    <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
                    <input type="hidden" name="flag" value="<?php echo $flag;?>">
                    <div class="row">
                      
                        <div class="input-field col s12">
                            <select name="empreendimento" id="empreendimento">
                                <option value="Empreendimento" disabled selected> </option>

                                <?php                                             
                                
                                foreach($empreendimento as $index => $code){

                                    ?>

                                    <option value="<?php echo $index;?>"><?php echo $code;?></option>

                                    <?php };
                                
                                
                                
                                ?>

                                

                            </select>
                            <label>Qual empreendimento?</label>
                        </div>


                        

                        <div class="input-field col s12">
                        <button type="submit" class="btn-large indigo darken-4" name="btn-enviar">Avançar<i
                                class="material-icons right">send</i></button>
                    </div>

                    </div>




                   

            </div>
            </form>


        </div>

    </div>
</div>
</div>


<?php 

include_once __DIR__ ."/footer.php";
?>