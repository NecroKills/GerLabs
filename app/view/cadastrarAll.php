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
?>
  <div class="content-wrapper">
      <div class="container">
        <div class="card mx-auto mt-5">
          <div class="card-header">Cadastrar Hardware</div>
          <div class="card-body">
            <form id="addProcessador" class="form-horizontal">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="inputProcessador">Processador</label>
                    <input class="form-control" name="processador[nome]" placeholder="I5" aria-describedby="processadorHelp">
                  </div>
                  <div class="col-md-6" style="padding-top: 31px">
                    <input class="btn btn-primary" onclick="cadastrarProcessador()"  type="button" value="Cadastrar">
                  </div>
                </div>
              </div>
              <input type="hidden" name="acao" value="addProcessador">
            </form>
            <form id="addMemoria" class="form-horizontal">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="inputMemoria">Memoria</label>
                    <input class="form-control" name="memoria[nome]" placeholder="8GB" aria-describedby="memoriaHelp">
                  </div>
                  <div class="col-md-6" style="padding-top: 31px">
                      <input class="btn btn-primary" onclick="cadastrarMemoria()" type="button" value="Cadastrar">
                  </div>
                </div>
              </div>
              <input type="hidden" name="acao" value="addMemoria">
            </form>
            <form id="addPlacaDeVideo" class="form-horizontal">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="inputPlaca_de_video">Placa de video</label>
                    <input class="form-control" name="placa_de_video[nome]" placeholder="GTX 650TI 1GB" aria-describedby="placaDeVideoHelp">
                  </div>
                  <div class="col-md-6" style="padding-top: 31px">
                    <input class="btn btn-primary" onclick="cadastrarPlaca_de_video()" type="button" value="Cadastrar">
                  </div>
                </div>
              </div>
              <input type="hidden" name="acao" value="addPlacaDeVideo">
            </form>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="card mx-auto mt-5">
          <div class="card-header">Cadastrar Software</div>
            <div class="card-body">
              <div class="form-group">
                <form id="addSoftwares" class="form-horizontal">
                  <div class="form-row" id="dynamicDiv">
                    <div class="col-md-2">
                      <label for="inputPlaca_de_video">Nome</label>
                      <input class="form-control" name="softwares[nome]" placeholder="baidu" aria-describedby="placaDeVideoHelp">
                    </div>
                    <div class="col-md-2">
                      <label for="inputPlaca_de_video">Vesão</label>
                      <input class="form-control" name="softwares[versao]" placeholder="v 1.0.1" aria-describedby="placaDeVideoHelp">
                    </div>
                    <div class="col-md-2">
                      <label for="inputPlaca_de_video">Tipo</label>
                      <select class="form-control" name="softwares[tipo]">
                        <option disabled="disabled" selected="selected"> - 	     	selecione - </option>
                        <option value="1">Software</option>
                        <option value="0">Sistema Operacional</option>
                      </select>
                    </div>
                    <div class="col-md-3" style="padding-top: 31px">
                      <input class="btn btn-primary" onclick="cadastrarSoftware()" type="button" value="Cadastrar">
                    </div>
                    <div class="col-md-3" style="padding-top: 31px" >
                      <p>
                        <a class="btn btn-danger" href="javascript:void(0)" id="addInput">
                          <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                          Adicionar campo
                        </a>
                      </p>
                    </div>
                  </div>
                  <input type="hidden" name="acao" value="addSoftware">
                </form>
              </div>
            </div>
          </div>
        </div>
      <div class="container">
        <div class="card mx-auto mt-5">
          <div class="card-header">Cadastrar Professor</div>
            <div class="card-body">
              <form id="addProfessor" class="form-horizontal">
                <div class="form-group">
                <div class="form-row">
                  <div class="col-md-4">
                    <label for="inputProcessador">Nome</label>
                    <input class="form-control" name="professor[nome]" placeholder="fulano" aria-describedby="processadorHelp">
                  </div>
                  <div class="col-md-4">
                    <label for="inputProcessador">Matricula</label>
                    <input class="form-control" name="professor[matricula]" placeholder="00001211" aria-describedby="processadorHelp">
                  </div>
                  <div class="col-md-4" style="padding-top: 31px">
                    <input class="btn btn-primary" type="button" onclick="CadastrarProfessor()" value="Cadastrar">
                  </div>
                </div>
                </div>
                <input type="hidden" name="acao" value="addProfessor">
              </form>
            </div>
          </div>
        </div>
  </div>

  <script>
  function cadastrarProcessador()
  {
    var addProcessador = $('#addProcessador').serialize();
    $.ajax({
     url: '../route/criar.php',
     type: "POST",
     dataType: "json",
     data: addProcessador,
     success: function(resp){
       if(resp.success == true) {
         alert(resp.text);
         location.reload();
       } else {
         alert(resp.text);
         location.reload();
       }
     }
    });
  }

  function cadastrarMemoria()
  {
    var addMemoria = $('#addMemoria').serialize();
    $.ajax({
     url: '../route/criar.php',
     type: "POST",
     dataType: "json",
     data: addMemoria,
     success: function(resp){
       if(resp.success == true) {
         alert(resp.text);
         location.reload();
       } else {
         alert(resp.text);
         location.reload();
       }
     }
    });
  }

  function cadastrarPlaca_de_video()
  {
    var addPlacaDeVideo = $('#addPlacaDeVideo').serialize();
    $.ajax({
     url: '../route/criar.php',
     type: "POST",
     dataType: "json",
     data: addPlacaDeVideo,
     success: function(resp){
       if(resp.success == true) {
         alert(resp.text);
         location.reload();
       } else {
         alert(resp.text);
         location.reload();
       }
     }
    });
  }

  function cadastrarSoftware()
  {
    var addSoftware = $('#addSoftwares').serialize();
    $.ajax({
     url: '../route/criar.php',
     type: "POST",
     dataType: "json",
     data: addSoftware,
     success: function(resp){
       if(resp.success == true) {
         alert(resp.text);
         location.reload();
       } else {
         alert(resp.text);
         location.reload();
       }
     }
    });
  }

  function CadastrarProfessor()
  {
    var addProfessor = $('#addProfessor').serialize();
    $.ajax({
     url: '../route/criar.php',
     type: "POST",
     dataType: "json",
     data: addProfessor,
     success: function(resp){
       if(resp.success == true) {
         alert(resp.text);
         location.reload();
       } else {
         alert(resp.text);
         location.reload();
       }
     }
    });
  }

  $(function () {
      var scntDiv = $('#dynamicDiv');
      $(document).on('click', '#addInput', function () {
          $('<p>'+
            '<input class="form-control" id="input1" placeholder="baidu" aria-describedby="placaDeVideoHelp">'+
            '<input class="form-control" id="input2" placeholder="v 1.0.1" aria-describedby="placaDeVideoHelp">'+
            '<select class="form-control" id="input3"><option disabled="disabled" selected="selected"> - 	     	selecione - </option><option value="1">Software</option><option value="0">Sistema Operacional</option></select>'+
            '<a class="btn btn-danger" href="javascript:void(0)" id="remInput"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Remover Campo</a>'+
           '</p>').appendTo(scntDiv);
          return false;
      });
      $(document).on('click', '#remInput', function () {
            $(this).parents('p').remove();
          return false;
      });
  });
  </script>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
