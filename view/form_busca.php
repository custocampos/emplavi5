<nav>
  <div class="nav-wrapper indigo lighten-5">
    <h4 class="brand-logo center black-text">Cadastro de visita à central</h4>
    <h6 href="#" class="brand-logo right"><img src='view/logotipo_emplavi-2.png' width='263' height='48' /></h6>
    <ul id="nav-mobile" class="left hide-on-med-and-down">
  </div>
</nav>



<div class="row">
  <div class="col s12 m6 push-m3 ">
    <div class="card indigo lighten-5">
      <div class="card-content">
        <form class="container " action="./controller/criar.php" method="POST">
          <div class="row  ">
            <div class="input-field col s12">

              <input type="text" name="nome" id="autocomplete-input" class="autocomplete1">
              <label for="autocomplete-input">Nome do visitante</label>
            </div>
            <div class="input-field col s12">

              <input type="text" name="email" id="autocomplete-email" class="autocomplete2">
              <label for="autocomplete-email">E-mail</label>
            </div>

            <div class="input-field col s12">
              <input type="text" name="telefone" id="telefone" class="autocomplete3"/>
              <label for="telefone">Telefone</label>
            </div>



            <div class="input-field col s12">
              <button type="submit" class="btn-large indigo darken-4" name="btn-enviar">Cadastrar contato<i
                  class="material-icons right">send</i></button>
            </div>

          </div>
        </form>


      </div>

    </div>
  </div>
</div>