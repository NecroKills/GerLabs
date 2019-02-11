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
require_once("../controller/ReservaController.php");
$reserva = new ReservaController();
$events = $reserva->buscarEventos();
require_once("../controller/LaboratorioController.php");
$laboratorios = new LaboratorioController();
$buscarNome = $laboratorios->buscarNomeLaboratorios();
require_once("../controller/ReservaController.php");
$professor = new ReservaController();
$buscarProfessor = $professor->buscarProfessor();
?>
<!-- DANDO PROBLEMA NO LAYOUT-->
<link href="/modelo/assets/bootstrap-personalizado-gerlabs/css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="/modelo/assets/vendor/full-calendar/css/bootstrap.min.css" rel="stylesheet"> -->
<!--                -->
<link href='/modelo/assets/vendor/full-calendar/css/fullcalendar.css' rel='stylesheet' />
<!-- <script src="/modelo/assets/vendor/jquery/jquery.js"></script> -->
<script src="/modelo/assets/vendor/full-calendar/js/jquery.js"></script>
<!-- <script src="/modelo/assets/vendor/bootstrap/js/bootstrap.min.js"></script> -->
<script src="/modelo/assets/vendor/full-calendar/js/bootstrap.min.js"></script>

<script src='/modelo/assets/vendor/full-calendar/js/moment.min.js'></script>
<script src='/modelo/assets/vendor/full-calendar/js/fullcalendar.min.js'></script>

<div class="content-wrapper">
  <div class="container">
    <div class="form-group">
      <div class="form-row">
        <div class="col-md-6">
          <label for="laboratorios">Selecione o laboratorios:</label>
          <select class="form-control" id="laboratorio" name="laboratorios[nome]" onchange="buscarHorarios()">
            <option disabled="disabled" selected="selected"> - selecione - </option>
            <?php foreach($buscarNome as $key => $laboratorios) {?>
            <option value="<?php echo $laboratorios["id"]; ?>"> <?php echo $laboratorios["nome"]; ?>  </option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
        <!-- View FullCalendar -->
    <div class="form-group">
      <div class="form-row">
        <div class="col-md-12">
            <div id="calendar"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div id="ModalAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <form id="addreserva" class="form-horizontal">
          <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Adicionar reserva</h4>
          </div>
          <input type="hidden" name="acao" value="cadastrarEvento">
          <div class="modal-body">
            <div class="form-group">
              <label for="usr">Titulo:</label>
              <input name="reserva[title]" type="text" class="form-control" id="title">
            </div>
            <div class="form-group">
              <label for="usr">Cor:</label>
              <select name="reserva[color]" class="form-control" id="color">
                <option value="">-- Selecionar</option>
                <option style="color:#0071c5;" value="#0071c5">&#9724; Azul Escuro</option>
                <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
                <option style="color:#008000;" value="#008000">&#9724; Verde</option>
                <option style="color:#FFD700;" value="#FFD700">&#9724; Amarelo</option>
                <option style="color:#FF8C00;" value="#FF8C00">&#9724; Laranja</option>
                <option style="color:#FF0000;" value="#FF0000">&#9724; Vermelho</option>
                <option style="color:#000;" value="#000">&#9724; Preto</option>
              </select>
            </div>
            <div class="form-group">
              <label for="usr">Professor:</label>
              <select name="reserva[professores_id]" class="form-control">
                <option value="">-- Selecionar</option>
                <?php foreach($buscarProfessor as $key => $professor) {?>
                <option value="<?php echo $professor["id"]; ?>"> <?php echo $professor["nome"]; ?>  </option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="usr">Dia:</label>
              <input name="reserva[start]" type="text" class="form-control" id="start" readonly>
            </div>
            <div class="form-group">
              <label for="usr">Hora início:</label>
              <input name="reserva[hrinicio]" type="time" class="form-control">
            </div>
            <div class="form-group">
              <label for="usr">Hora fim:</label>
              <input name="reserva[hrfim]" type="time" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          <button type="button" onclick="cadastrarEvento()" class="btn btn-primary">Reservar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div id="ModalEdit" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="editarEvento" class="form-horizontal">
  			  <div class="modal-header">
  				<h4 class="modal-title" id="myModalLabel">Editar evento</h4>
  			  </div>
          <input type="hidden" name="acao" value="editarReserva">
  			  <div class="modal-body">
  				  <div class="form-group">
  					<label for="title" class="col-sm-2 control-label">Titulo</label>
  					<div class="col-sm-10">
  					  <input type="text" name="editar[title]" class="form-control" id="title" placeholder="Title">
  					</div>
  				  </div>
  				  <div class="form-group">
  					<label for="color" class="col-sm-2 control-label">Cor</label>
  					<div class="col-sm-10">
  					  <select name="editar[color]" class="form-control" id="color">
  						  <option value="">Selecionar</option>
  						  <option style="color:#0071c5;" value="#0071c5">&#9724; Azul Escuro</option>
  						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
  						  <option style="color:#008000;" value="#008000">&#9724; Verde</option>
  						  <option style="color:#FFD700;" value="#FFD700">&#9724; Amarelo</option>
  						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Laranja</option>
  						  <option style="color:#FF0000;" value="#FF0000">&#9724; Vermelho</option>
  						  <option style="color:#000;" value="#000">&#9724; Preto</option>
  						</select>
  					</div>
  				  </div>
  				    <div class="form-group">
  						<div class="col-sm-offset-2 col-sm-10">
  						  <div class="checkbox">
      						<label class="text-danger"><input type="checkbox"  name="editar[delete]"> Deletar evento</label>
  						  </div>
  						</div>
  					</div>
  				  <input type="hidden" name="editar[id]" class="form-control" id="id">
  			  </div>
  			  <div class="modal-footer">
  				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  				<button type="button" onclick="editarEvento()" class="btn btn-primary">Salvar alterações</button>
  			  </div>
  			</form>
      </div>
    </div>
  </div>
</div>

<script>
  function cadastrarEvento()
  {
    var laboratorio = $('#laboratorio').val();
    var formDados = $('#addreserva').serialize();
    formDados += '&reserva[laboratorios_id]='+laboratorio;
    $.ajax({
     url: '../route/criar.php',
     type: "POST",
     dataType: "json",
     data: formDados,
     success: function(evento){
       if(evento.success == true) {
         $('#addreserva').trigger("reset");
         alert(evento.text);
         buscarHorarios();
       } else {
         alert(evento.text);
       }
     }
    });
  }

  function editarEvento()
  {
    var laboratorio = $('#laboratorio').val();
    var formDados = $('#editarEvento').serialize();
    formDados += '&editar[laboratorios_id]='+laboratorio;
    $.ajax({
     url: '../route/editar.php',
     type: "POST",
     dataType: "json",
     data: formDados,
     success: function(evento){
       if(evento.success == true) {
         alert(evento.text);
         location.reload();
       } else {
         alert(evento.text);
         location.reload();
       }
     }
    });
  }

  function buscarHorarios()
  {
      var laboratorio = $('#laboratorio').val();
      $.ajax({
       url: '../route/listar.php',
       type: "POST",
       dataType: "json",
       data: {
         'acao': 'buscarDatasLaboratorio',
         'laboratorio': laboratorio
       },
       success: function(datas){
         // Remove todos os eventos que tem no fullcalendar
         $('#calendar').fullCalendar('removeEvents');
         datas.forEach(function(data) {
           $('#calendar').fullCalendar('renderEvent', {id: data.id, title: data.title, start: data.start, end: data.end, color: data.color}, true);
         });

       }
      });
  }

  $(document).ready(function() {
  	$('#calendar').fullCalendar({
      //PT-BR CALENDARIO
      monthNames:["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
      monthNamesShort:["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
      dayNames:["Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sábado"],
      dayNamesShort:["Dom","Seg","Ter","Qua","Qui","Sex","Sáb"],
      dayNamesMin:["Dom","Seg","Ter","Qua","Qui","Sex","Sáb"],
      longDateFormat:{LT:"HH:mm",LTS:"HH:mm:ss",L:"DD/MM/YYYY",LL:"D [de] MMMM [de] YYYY",LLL:"D [de] MMMM [de] YYYY [Ã s] HH:mm",LLLL:"dddd, D [de] MMMM [de] YYYY [Ã s] HH:mm"},
      relativeTime:{future:"em %s",past:"%s atrás",s:"poucos segundos",ss:"%d segundos",m:"um minuto",mm:"%d minutos",h:"uma hora",hh:"%d horas",d:"um dia",dd:"%d dias",M:"um mês",MM:"%d meses",y:"um ano",yy:"%d anos"},
      buttonText:{month:"Mês",week:"Semana",day:"Dia",list:"Compromissos"},
      allDayText:"dia inteiro",

  		header: {
  			left: 'prev,next today',
  			center: 'title',
  			right: 'month,agendaWeek,agendaDay,listWeek'
  		},
  		defaultDate: new Date(),
  		editable: true,
  		eventLimit: true, // allow "more" link when too many events
  		selectable: true,
  		selectHelper: true,
      //esconde o domingo.
      hiddenDays: [0],
  		select: function(start, end) {
        //Não deixa selecionar as datas passadas
        if(start.isBefore(moment())) {
          $('#calendar').fullCalendar('unselect');
          return false;
        }
  			$('#ModalAdd #start').val(moment(start).format('DD-MM-YYYY'));
  			$('#ModalAdd').modal('show');
  		},
  		eventRender: function(event, element) {
  			element.bind('dblclick', function() {
  				$('#ModalEdit #id').val(event.id);
  				$('#ModalEdit #title').val(event.title);
  				$('#ModalEdit #color').val(event.color);
  				$('#ModalEdit').modal('show');
  			});
  		},
  		eventDrop: function(event, delta, revertFunc) { // si changement de position

  			edit(event);

  		},
  		eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

  			edit(event);

  		},
  		events: [
        <?php foreach($events as $event):
  				$start = explode(" ", $event['start']);
  				$end = explode(" ", $event['end']);
  				if($start[1] == '00:00:00'){
  					$start = $start[0];
  				}else{
  					$start = $event['start'];
  				}
  				if($end[1] == '00:00:00'){
  					$end = $end[0];
  				}else{
  					$end = $event['end'];
  				}
  			?>
  				{
  					id: '<?php echo $event['id']; ?>',
  					title: '<?php echo $event['title']; ?>',
  					start: '<?php echo $start; ?>',
  					end: '<?php echo $end; ?>',
  					color: '<?php echo $event['color']; ?>',
  				},
  			<?php endforeach; ?>
  		]
  	});

  	function edit(event)
    {
  		start = event.start.format('YYYY-MM-DD HH:mm:ss');
  		if(event.end){
  			end = event.end.format('YYYY-MM-DD HH:mm:ss');
  		}else{
  			end = start;
  		}
  		id =  event.id;
      var laboratorio = $('#laboratorio').val();
  		Event = [];
  		Event[0] = id;
  		Event[1] = start;
  		Event[2] = end;
      Event[3] = laboratorio;
  		$.ajax({
  		 url: '../route/editar.php',
  		 type: "POST",
       dataType: "json",
  		 data: {
         'acao': 'editarData',
         Event:Event
       },
       success: function(evento){
         if(evento.success == true) {
           alert(evento.text);
         } else {
           alert(evento.text);
         }
       }
  		});
  	}

  });

</script>


    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
