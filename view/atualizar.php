<?php 
include_once __DIR__ ."/header.php";
require_once __DIR__ ."./../model/db_connect.php";
include_once __DIR__ . "/message.php";




if(isset($_GET["id"])){
  $id=$_GET["id"];
  $result=(array)json_decode(getContact($id));
  $result=(array)$result["result"];
  $name=$result["NAME"];


  if(!empty($result["LAST_NAME"])){
    $sobrenome=$result["LAST_NAME"];
  }else{
    $sobrenome="";
  };

  if(!empty($result["PHONE"][0])){
    $fone1=$result["PHONE"][0]->VALUE;
    }else{
      $fone1="";
    };
  if(!empty($result["PHONE"][1])){
    $fone2=$result["PHONE"][1]->VALUE;
    }else{
      $fone2="";
    };

  if(!empty($result["EMAIL"][0])){
    $mail=$result["EMAIL"][0]->VALUE;
    }else{
      $mail="";
    };
  
    
 

  // echo "<pre>";
  // var_dump($result);



    }else{
      header('location: ../index.php');
    };
?>


<nav>
  <div class="nav-wrapper indigo lighten-5">
    <h4 class="brand-logo center black-text">Atualizar contato</h4>
    <h6 href="#" class="brand-logo right"><img src='logotipo_emplavi-2.png' width='263' height='48' /></h6>
    <ul id="nav-mobile" class="left hide-on-med-and-down">
      <li><a href="./../index.php"><i class="material-icons left">home</i>Voltar para a tela inicial</a></li>
  </div>
</nav>


<div class="row">
  <div class="col s12 m6 push-m3">
    <div class="card indigo lighten-5">
      <div class="card-content">
        <form class="container" action="../controller/visita.php?id=<?php echo $id;?>" method="POST">
          <div class="row">
            <div class="input-field col s12">
              <input type="text" name="nome" id="nome" value="<?php echo $name;?>" />
              <label for="nome">Nome</label>
            </div>

            <div class="input-field col s12">
                    <input type="text" name="sobrenome" id="sobrenome" value="<?php echo $sobrenome;?>"/>
                    <label for="sobrenome">Sobrenome </label>
            </div>


            <div class="input-field col s12">
              <input type="text" name="email" id="email" value="<?php echo $mail;?>" />
              <label for="email">E-mail</label>
            </div>
            <div class="input-field col s12">
              <input type="text" name="tel" id="tel" value="<?php echo $fone1;?>" />
              <label for="tel">Telefone 1</label>
            </div>

            <div class="input-field col s12">
              <input type="text" name="tel2" id="tel2" value="<?php echo $fone2;?>" />
              <label for="tel2">Telefone 2</label>
            </div>

            

            <div class="input-field col s12">
              <button type="submit" class="btn-large indigo darken-4" name="btn-enviar">Avançar<i
                  class="material-icons right">send</i></button>
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


