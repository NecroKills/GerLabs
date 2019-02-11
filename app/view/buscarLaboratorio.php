<?php
session_start();

if(!isset($_SESSION["usuario"])){
  header("Location: index.php");
}else{
  if(isset($_SESSION['usuario']) && $_SESSION['usuario']['nivel'] == 3){
    header("Location: index.php");
  }
}
  if ($_SESSION['usuario']['nivel'] == 2)
  {
    require_once('headerMenuAdmin.php');
    require_once('footerMenuAdmin.php');
  }
  else
  {
    require_once('headerMenuUser.php');
    require_once('footerMenuUser.php');
  }

require_once("../controller/LaboratorioController.php");
$laboratorios = new LaboratorioController();
$buscarNome = $laboratorios->buscarNomeLaboratorios();
?>
  <div class="content-wrapper">
      <div class="container">
        <div class="card mx-auto mt-5">
          <div class="card-header">Buscar laboratorio</div>
          <div class="card-body">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="inputLaboratorios">Laboratorios</label>
                    <select class="form-control" id="laboratorio" name="laboratorios[nome]" aria-describedby="laboratorioHelp" placeholder="Selecione o laboratorio">
                      <option disabled="disabled" selected="selected"> - selecione - </option>
                      <?php foreach($buscarNome as $key => $laboratorios) {?>
                      <option value="<?php echo $laboratorios["id"]; ?>"> <?php echo $laboratorios["nome"]; ?>  </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                  </div>
                </div>
              </div>
                <input type="hidden" id="inputHidden" />
                <input class="btn btn-primary btn-block" type="button" onclick="buscar()" id="buscar" name="buscar" value="Buscar">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="inputNome">Nome</label>
                    <input class="form-control" disabled id="nomeLaboratorio" type="text">
                  </div>
                  <div class="col-md-6">
                    <label for="inputQComputadores">Quantidade de computadores</label>
                    <input class="form-control" disabled id="capacidadeLaboratorio" type="text">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="inputProcessador">Processador</label>
                    <input class="form-control" disabled id="nomeProcessador" type="text">
                  </div>
                  <div class="col-md-6">
                    <label for="inputMemoria">Memoria</label>
                    <input class="form-control" disabled  id="nomeMemoria" type="text">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="inputPlaca_de_video">Placa de video</label>
                    <input class="form-control" disabled id="nomePlaca_de_video" type="text">
                  </div>
                  <div class="col-md-6">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
                    <label for="inputSoftwares">Softwares</label>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="softwares-dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Versão</th>
                            <th>Tipo</th>
                          </tr>
                        </thead>
                        <tbody id="conteudoSoftwares">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>

<script>
function buscar()
{
  $.ajax({
    type: "POST",
    url: "../route/listar.php",
    data: {
      'acao': 'buscarLaboratorios',
      'laboratorio_id': $('#laboratorio').val()
    },
    success: function(laboratorio) {
      // Se existir a dataTable, irá destroir, porque os dados ficam salvos
      if($.fn.DataTable.isDataTable('#softwares-dataTable')) {
        $('#softwares-dataTable').DataTable().destroy();
      }
      $("#nomeLaboratorio").val(laboratorio.nome);
      $("#capacidadeLaboratorio").val(laboratorio.capacidade);
      $("#nomeProcessador").val(laboratorio.processador);
      $("#nomeMemoria").val(laboratorio.memoria);
      $("#nomePlaca_de_video").val(laboratorio.placa_de_video);
      $("#softwares").val(laboratorio.softwares);

      // Cria uma variavel vazia, pois logo abaixo iremos incrementar algo nela.. caso a gente tente incremetar uma variavel
      // sem existir, irá criar uma variável com lixo dentro
      var dadosSoftwares = '';
      laboratorio.softwares.forEach(function(software) {
        dadosSoftwares += '<tr>'+
                              '<th>'+software.nome+'</th>'+
                              '<th>'+software.versao+'</th>'+
                              '<th>'+software.tipo+'</th>'+
                          '</tr>';
      });
      $('#conteudoSoftwares').html(dadosSoftwares);
      $('#softwares-dataTable').dataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        }
      });
    },
    dataType: 'json'
  });
}
</script>
      <script src="/modelo/assets/js/sb-admin-datatables.min.js"></script>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
