<?php 
include_once __DIR__ ."/header.php";
include_once __DIR__ . "/message.php";

//session_start();
if(isset($_SESSION['dados'])){
  $nome=$_SESSION['dados'][0];
  $telefone=$_SESSION['dados'][2];
  $email=$_SESSION['dados'][1];
  }else{
    $nome="";
    $telefone="";
    $email="";
  }

session_unset();
?>


<nav>
  <div class="nav-wrapper indigo lighten-5">
    <h4 class="brand-logo center black-text">Novo contato</h4>
    <h6 href="#" class="brand-logo right"><img src='logotipo_emplavi-2.png' width='263' height='48' /></h6>
    <ul id="nav-mobile" class="left hide-on-med-and-down">
    <li><a href="./../index.php"><i class="material-icons left">home</i>Voltar para a tela inicial</a></li>
  </div>
</nav>


<div class="row">
  <div class="col s12 m6 push-m3">
    <div class="card indigo lighten-5">
      <div class="card-content">
          <form class="container" action="../controller/novo.php" method="POST">
            <div class = "row">
            <div class="input-field col s12">
                    
            <input type="text" name="nome" id="nome" value="<?php echo $nome;?>"/>
                    <label for="nome">Nome </label>
            </div>
            
            <div class="input-field col s12">
                    <input type="text" name="sobrenome" id="sobrenome"/>
                    <label for="sobrenome">Sobrenome </label>
            </div>

            <div class="input-field col s12">
                    <input type="text" name="email" id="email" value="<?php echo $email;?>"/>
                    <label for="email">E-mail</label>
            </div>
            <div class="input-field col s12">
                    <input type="text" name="tel" id="tel" value="<?php echo $telefone;?>"/>
                    <label for="tel">Telefone 1</label>
            </div>

            <div class="input-field col s12">
                    <input type="text" name="tel2" id="tel2" />
                    <label for="tel2">Telefone 2</label>
            </div>

            
            
            
              
            
            <div class="input-field col s12">
                <button  type="submit" class="btn-large indigo darken-4" name="btn-enviar">Avançar<i class="material-icons right">send</i></button>
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