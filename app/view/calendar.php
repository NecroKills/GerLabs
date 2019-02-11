<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href='../../fullcalendar/fullcalendar.min.css' rel='stylesheet' />
    <link href='../../fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='../../fullcalendar/lib/moment.min.js'></script>
    <script src='../../fullcalendar/lib/jquery.min.js'></script>
    <script src='../../fullcalendar/fullcalendar.min.js'></script>
    <script src='../../fullcalendar/locale/pt-br.js'></script>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../assets/js/bootstrap.min.js"></script>



    <title>Calendar</title>
    <?php require_once("calendarFunction.php"); ?>

  </head>
  <body>
    <div id='calendar'></div>


  <div id="modal" class="modal fade" role="dialog">
    <div class="modal-content">
      <div class="modal-dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Criar Reserva</h4>
      </div>
      <form id="Reservar" action="../route/criar.php" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="usr">Curso:</label>
            <input name="curso" type="text" class="form-control" id="curso">
          </div>
          <div class="form-group">
            <label for="usr">Professor:</label>
            <input name="professor" type="text" class="form-control" id="professor">
          </div>
          <div class="form-group">
            <label for="usr">Laboratorio:</label>
            <input name="laboratorio" type="text" class="form-control" id="curso">
          </div>
        </div>
        <div class="modal-footer">
          <a type="button" id="salvar" class="btn btn-default" data-dismiss="modal">Salvar</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        <input type="hidden" name="acao" value="criarReserva">
      </form>
    </div>
      </div>
  </div>
  </body>
</html>
