<?php
session_start();
if(!isset($_SESSION["usuario"])){
  header("Location: index.php");
}else{
  if(isset($_SESSION['usuario']) && $_SESSION['usuario']['nivel'] == 1){
    header("Location: index.php");
  }
}
require_once('headerMenuAdmin.php');
require_once('footerMenuAdmin.php');
require_once("../controller/LaboratorioController.php");
$hardwares = new LaboratorioController();
$software = new LaboratorioController();
$processadores = $hardwares->buscarProcessador();
$memorias = $hardwares->buscarMemoria();
$placa_de_videos = $hardwares->buscarPlaca_de_video();
$softwares = $software->buscarSoftwares();
?>
  <div class="content-wrapper">
      <div class="container">
        <div class="card mx-auto mt-5">
          <div class="card-header">Cadastrar laboratorio</div>
          <div class="card-body">
            <form id="formularioCadastro" onSubmit="return validar(this);">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="inputNome">Nome</label>
                    <input class="form-control" name="laboratorio[nome]" placeholder="Laboratório 01" aria-describedby="laboratorioHelp">
                  </div>
                  <div class="col-md-6">
                    <label for="inputQComputadores">Quantidade de computadores</label>
                    <input class="form-control" name="laboratorio[capacidade]" placeholder="30" aria-describedby="nameHelp">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="inputProcessador">Processador</label>
                    <select class="form-control" name="hardwares[processador_id]" id="nomeProcessador">
                      <option disabled="disabled" selected="selected"> - 	     	selecione - </option>
                      <?php foreach($processadores as $key => $processador) {?>
                          <option value="<?php echo $processador["id"]; ?>"> <?php echo $processador["nome"]; ?>  </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="inputMemoria">Memoria</label>
                    <select class="form-control" name="hardwares[memoria_id]" id="nomeMemoria">
                      <option disabled="disabled" selected="selected"> - 	     	selecione - </option>
                      <?php foreach($memorias as $key => $memoria) {?>
                          <option value="<?php echo $memoria["id"]; ?>"><?php echo $memoria["nome"]; ?>  </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="inputPlaca_de_video">Placa de video</label>
                    <select class="form-control" name="hardwares[placa_de_video_id]" id="nomePlaca_de_video">
                      <option disabled="disabled" selected="selected"> - 	     	selecione - </option>
                      <?php foreach($placa_de_videos as $key => $placa_de_video) {?>
                          <option value="<?php echo $placa_de_video["id"]; ?>"> <?php echo $placa_de_video["nome"]; ?>  </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="inputSoftwares">Softwares</label>
                    <br>
                    <select class="form-control" id="softwares" size="50" name="softwares[]" multiple="multiple">
                      <?php foreach($softwares as $key => $software) {?>
                        <?php
                          if ($software["tipo"] == 1){
                            $software["tipo"] = "software";
                          } elseif ($software["tipo"] == 0){
                            $software["tipo"] = "Sistema operacional";
                          }
                          ?>
                      <option value="<?php echo $software["id"]; ?>"> <?php echo $software["nome"]; ?>
                        <?php echo 'Versão: '. $software["versao"]; ?> <?php echo ' Tipo: '. $software["tipo"]; ?>
                      </option>
                      <?php } ?>
                      </select>
                  </div>
                </div>
              </div>
              <input class="btn btn-primary btn-block" type="button" onclick="cadastrarLaboratorio()" name="cadastrar" value="Cadastrar">
                <!--             hidden             -->
                <input type="hidden" name="acao" value="criarLaboratorios">
            </form>
          </div>
        </div>
      </div>

<script src="/modelo/assets/vendor/jquery-validate/jquery.validate.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
      $('#softwares').multiselect();
  });

  function cadastrarLaboratorio()
  {
    var formDados = $('#formularioCadastro').serialize();
    $.ajax({
     url: '../route/criar.php',
     type: "POST",
     dataType: "json",
     data: formDados,
     success: function(cadastrar){
       if(cadastrar.success == true) {
         alert(cadastrar.text);
         location.reload();
       } else {
         alert(cadastrar.text);
       }
     }
    });
  }

  $(document).ready( function() {
        $("#formularioCadastro").validate({
            rules: {
              'laboratorio[nome]': {required: true},
              'laboratorio[capacidade]': {required: true},
              'hardwares[processador_id]': {required: true},
              'hardwares[memoria_id]': {required: true},
              'hardwares[placa_de_video_id]': {required: true},
              'softwares[]': {required: true},
            },
            messages: {
              'laboratorio[nome]': {required: "Digite o seu usuario"},
              'laboratorio[capacidade]': {required: "Digite seu nome"},
              'hardwares[processador_id]': {required: "Digite o seu e-mail"},
              'hardwares[memoria_id]': {required: "Digite sua senha"},
              'hardwares[placa_de_video_id]': {required: "Digite sua senha"},
              'softwares[]': {required: "Digite sua senha"}
            }
        });
    });
</script>

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
