<!DOCTYPE html>
<html lang="pt">
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
require_once("../controller/UsuarioController.php");
$usuario = new UsuarioController();
$usuarios = $usuario->getAll();
?>
    <div class="content-wrapper">
        <div class="container-fluid">
          <!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> Buscar usuário</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Situação</th>
                      <th>Nivel</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Situação</th>
                      <th>Nivel</th>
                      <th>Ação</th>
                    </tr>
                  </tfoot>
                  <tbody>
                          <?php
                            foreach($usuarios as $key => $usuario) {
                              echo "<tr>";
                                echo "<td>".$usuario["id"]."</td>";
                                echo "<td>".$usuario["nome"]."</td>";
                                echo "<td>".$usuario["email"]."</td>";
                                echo "<td>".$usuario["situacao"]."</td>";
                                echo "<td>".$usuario["nivel"]."</td>";
                                echo "<td>
                                  <a onclick='editar(".$usuario["id"].");'><span class='fa fa-pencil'></span></a>
                                  <a onclick='modalExcluir(".$usuario["id"].");'><span class='fa fa-trash' style='padding-left: 6px;'></span></a>
                                </td>";
                              echo "</tr>";
                            }
                          ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted"></div>
          </div>
        </div>

      <!-- /.container-fluid-->
      <!-- /.content-wrapper-->
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top" style="display: inline;">
            <i class="fa fa-angle-up"></i>
          </a>

          <!-- Modal -->
          <div id="modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Editar usuário</h4>
                </div>
                <form id="atualizarUsuario" action="../route/editar.php" method="post">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="usr">Nome:</label>
                      <input name="nome" type="text" class="form-control" id="nome">
                    </div>
                    <div class="form-group">
                      <label for="usr">Email:</label>
                      <input name="email" type="text" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                      <label for="usr">Situação:</label>
                      <input name="situacao" type="text" class="form-control" id="situacao">
                    </div>
                    <div class="form-group">
                      <label for="usr">Nivel:</label>
                      <input name="nivel" type="text" class="form-control" id="nivel">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a type="button" id="salvar" class="btn btn-primary" data-dismiss="modal">Salvar</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  <input type="hidden" name="acao" value="atualizarUsuario">
                </form>
              </div>

            </div>
          </div>

      <!-- Logout Modal-->
      <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Deseja exluir o Usuário? </h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Selecione "Excluir" abaixo se você tiver certeza que deseja excluir o usuário.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" id="buttonExcluir" data-dismiss="modal">Excluir</a>
            </div>
          </div>
        </div>
      </div>
    </div>

<script>
  function modalExcluir(id){
    $("#modalExcluir").modal();
    $("#buttonExcluir").attr("onclick", "excluir("+id+")");
  }

  function excluir(id)
{
  $.ajax({
    type: "POST",
    url: "../route/excluir.php",
    data: {
      'acao': 'excluirUsuario',
      'user_id': id
    },
    success: function(resp) {
      location.reload();
    },
    dataType: 'json'
  });
}

  function editar(id)
  {
    $.ajax({
      type: "POST",
      url: "../route/listar.php",
      data: {
        'acao': 'buscarUsuario',
        'user_id': id
      },
      success: function(usuario) {
        $("#id").val(usuario.id);
        $("#email").val(usuario.email);
        $("#nome").val(usuario.nome);
        $("#situacao").val(usuario.situacao);
        $("#nivel").val(usuario.nivel);
        $("#salvar").attr("onclick", "atualizar("+usuario.id+")");
        $("#modal").modal();
      },
      dataType: 'json'
    });
  }

  function atualizar(id){
    var dados = $("#atualizarUsuario").serialize();
    dados += "&id="+id;
    $.ajax({
      type: "POST",
      url: "../route/editar.php",
      data: dados,
      success: function(resp) {
        alert(resp);
        window.reload();
      },
      dataType: 'json'
    });
  }
</script>

<script src="/modelo/assets/js/sb-admin-datatables.min.js"></script>
