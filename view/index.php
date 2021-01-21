<?php
include_once __DIR__ . "/message.php";
include_once __DIR__ ."/header.php";
require_once __DIR__ ."./../model/db_connect.php";

echo "<link href= 'view/stylesheet.css' rel='stylesheet' type='text/css' />";


// $names=(array)json_decode(criaArray());
// $names=(array)$names["result"];

// $arrayIdent["id"]=[];
// $arrayIdent["nome"]=[];



$arrayAssoc=[];

$arrayAssoc2=[];

$arrayAssoc3=[];

$cont=0;
$a=0;
$arrayIdent["id"]=[];
$arrayIdent["nome"]=[];
$arrayIdent["email"]=[];
$arrayIdent["phone"]=[];
$arrayIdent["idEmail"]=[];
$arrayIdent["idPhone"]=[];

while($a==0){

    $InfCont=(array)json_decode(listContact($cont));
    $InfCont=(array)$InfCont["result"];
    
//     sleep(1);
//     echo "<pre>";
//     var_dump($cont); 
//     var_dump($a);
    

    if(empty($InfCont)){
        $a=1;
    }else{

        foreach($InfCont as $data){
            $IdTaskk=$data->ID;
            $cont=$IdTaskk;
            array_push($arrayIdent["id"],$data->ID);
            if(!empty($data->LAST_NAME)){
              array_push($arrayIdent["nome"],$data->NAME." ".$data->LAST_NAME);
              $a=$data->NAME." ".$data->LAST_NAME;
              array_push($arrayAssoc,array($a => null));
            }else{
              array_push($arrayIdent["nome"],$data->NAME);
              $a=$data->NAME;
              array_push($arrayAssoc,array($a => null));
            }

            if(isset($data->EMAIL)){
              $b=$data->EMAIL;
              $b=$b[0]->VALUE;
              array_push($arrayIdent["email"],$b);
              array_push($arrayIdent["idEmail"],$data->ID);
              array_push($arrayAssoc2,array($b => null));
            }
            
            if(isset($data->PHONE)){
              $c=$data->PHONE;
              $c=$c[0]->VALUE;
              array_push($arrayIdent["phone"],$c);
              array_push($arrayIdent["idPhone"],$data->ID);
              array_push($arrayAssoc3,array($c => null));
            }
        }
        }
    

}



$arrayAssoc=json_encode($arrayAssoc);
$arrayAssoc=str_replace( ['{','}','[',']'], "",$arrayAssoc);

$arrayAssoc2=json_encode($arrayAssoc2);
$arrayAssoc2=str_replace( ['{','}','[',']'], "",$arrayAssoc2);

$arrayAssoc3=json_encode($arrayAssoc3);
$arrayAssoc3=str_replace( ['{','}','[',']'], "",$arrayAssoc3);

$_SESSION['id']=$arrayIdent["id"];
$_SESSION['nome']=$arrayIdent["nome"];

$_SESSION['email']=$arrayIdent["email"];
$_SESSION['phone']=$arrayIdent["phone"];

$_SESSION['idEmail']=$arrayIdent["idEmail"];
$_SESSION['idPhone']=$arrayIdent["idPhone"];

//echo "<pre>";
//var_dump($arrayIdent["id"]);

include __DIR__."/form_busca.php";


?>
<script>
  $(document).ready(function(){
    
    $('input.autocomplete1').autocomplete({
      data: {<?php echo $arrayAssoc; ?>},
      onAutocomplete: function(res){
        //document.getElementById("res").innerHTML=res;

        var dados = JSON.stringify(res);

        $.ajax({
        url: 'controller/recebe.php',
        type: 'POST',
        data: {data: dados},
        success: function(result){
          // Retorno se tudo ocorreu normalmente
          var response = $.parseJSON(result);

          var htmlStru = "<h5>Confirme se é esta pessoa:</h5>" +
                    "<p>Nome: " + response[0].username + "</p>" +
                    "<p >Telefone: " + response[0].phone + "</p>" +
                    "<p>Email: " + response[0].email + "</p>" ;

                
          $('#modal-content').html(htmlStru);
          $("#idCon").val(response[0].id);
          // document.getElementById("modal-content").innerHTML=;
          // document.getElementById("idCon").value=response[0].id;

          $('#modal').modal('open');
        },
        
      });        

      }});

      


  });


  
</script> 

<script> 
$(document).ready(function(){

  $('input.autocomplete2').autocomplete({
      data: {<?php echo $arrayAssoc2; ?>},
      onAutocomplete: function(res){
        //document.getElementById("res").innerHTML=res;

        var dados = JSON.stringify(res);

        $.ajax({
        url: 'controller/recebe2.php',
        type: 'POST',
        data: {data: dados},
        success: function(result){
          // Retorno se tudo ocorreu normalmente
          var response = $.parseJSON(result);

          var htmlStru = "<h5>Confirme se é esta pessoa:</h5>" +
                    "<p>Nome: " + response[0].username + "</p>" +
                    "<p >Telefone: " + response[0].phone + "</p>" +
                    "<p>Email: " + response[0].email + "</p>" ;

                
          $('#modal-content').html(htmlStru);
          $("#idCon").val(response[0].id);
          // document.getElementById("modal-content").innerHTML=;
          // document.getElementById("idCon").value=response[0].id;

          $('#modal').modal('open');
        },
        
      });        

      }})




});
</script> 


<script> 
$(document).ready(function(){

  $('input.autocomplete3').autocomplete({
      data: {<?php echo $arrayAssoc3; ?>},
      onAutocomplete: function(res){
        //document.getElementById("res").innerHTML=res;

        var dados = JSON.stringify(res);

        $.ajax({
        url: 'controller/recebe3.php',
        type: 'POST',
        data: {data: dados},
        success: function(result){
          // Retorno se tudo ocorreu normalmente
          var response = $.parseJSON(result);

          var htmlStru = "<h5>Confirme se é esta pessoa:</h5>" +
                    "<p>Nome: " + response[0].username + "</p>" +
                    "<p >Telefone: " + response[0].phone + "</p>" +
                    "<p>Email: " + response[0].email + "</p>" ;

                
          $('#modal-content').html(htmlStru);
          $("#idCon").val(response[0].id);
          

          $('#modal').modal('open');
        },
        
      });        

      }})




});
</script> 


<div id="modal" class="modal">
  <div class="modal-content" id="modal-content">
  </div>


    <div class="modal-footer">
      
        <form action="./controller/atualizar.php" method="POST">
          <input type="hidden" name="id" id="idCon" value="">
          <a href="#!"
            class="modal-action modal-close waves-effect waves-red btn-flat grey lighten-3">Cancelar</a>
          <button type="submit" name="btn-mandar" class="waves-effect waves-light btn">Sim, é essa pessoa</button>
        </form>
    </div>
    
</div>
  



<?php

// Footer
include_once __DIR__ ."/footer.php";
?>


