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
$laboratorios = new LaboratorioController();
$buscarNome = $laboratorios->buscarNomeLaboratorios();
require_once("../controller/ReservaController.php");
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

    <!-- MODAL EDITAR -->
    <div id="ModalEdit" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="editarEvento" class="form-horizontal">
    			  <div class="modal-header">
    				<h4 class="modal-title" id="myModalLabel">Editar evento</h4>
    			  </div>
    			  <div class="modal-body">
    				  <div class="form-group">
      					<label for="title" class="col-sm-2 control-label">Titulo</label>
      					<div class="col-sm-10">
      					  <input type="text" name="editar[title]" class="form-control" id="title">
      					</div>
    				  </div>
              <input type="hidden" name="acao" value="editarStatusReserva">
              <div class="form-group">
                <label for="color" class="col-sm-2 control-label">Color</label>
                <div class="col-sm-10">
                  <select name="editar[color]" class="form-control" id="color">
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
      					<label for="Usuario" class="col-sm-2 control-label">Usuario</label>
      					<div class="col-sm-10">
      					  <input type="text" name="editar[usuario]" class="form-control" id="usuario">
      					</div>
    				  </div>
              <div class="form-group">
      					<label for="Email" class="col-sm-2 control-label">Email</label>
      					<div class="col-sm-10">
      					  <input type="text" name="editar[email]" class="form-control" id="email">
      					</div>
    				  </div>
              <div class="form-group">
      					<label for="Professor" class="col-sm-2 control-label">Professor</label>
      					<div class="col-sm-10">
      					  <input type="text" name="editar[professor]" class="form-control" id="professor">
      					</div>
    				  </div>
              <div class="form-group">
      					<label for="Laboratorio" class="col-sm-2 control-label">Laboratorio</label>
      					<div class="col-sm-10">
      					  <input type="text" name="editar[laboratorio]" class="form-control" id="laboratorio">
      					</div>
    				  </div>
              <div class="form-group">
      					<label for="horaInicio" class="col-sm-2 control-label">Hora inicio</label>
      					<div class="col-sm-10">
      					  <input type="text" name="editar[horaInicio]" class="form-control" id="horaInicio">
      					</div>
    				  </div>
              <div class="form-group">
      					<label for="horaFim" class="col-sm-2 control-label">Hora fim</label>
      					<div class="col-sm-10">
      					  <input type="text" name="editar[horaFim]" class="form-control" id="horaFim">
      					</div>
    				  </div>
              <div class="form-group">
                <label for="situacao" class="col-sm-2 control-label">Situação</label>
                <div class="col-sm-10">
                  <select name="editar[situacao]" class="form-control" id="situacao">
                    <option value="">Selecionar</option>
                    <option value="0">Em espera</option>
                    <option value="1">Aprovado</option>
                    <option value="2">Rejeitado</option>
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
            <!-- /.container -->

<script>
  function buscarHorarios()
  {
      var laboratorio = $('#laboratorio').val();
      $.ajax({
       url: '../route/listar.php',
       type: "POST",
       dataType: "json",
       data: {
         'acao': 'buscarDatasSolicitacoesLaboratorio',
         'laboratorio': laboratorio
       },
       success: function(datas){
         // Remove todos os eventos que tem no fullcalendar
         $('#calendar').fullCalendar('removeEvents');
         datas.forEach(function(data) {
           $('#calendar').fullCalendar('renderEvent', {id: data.id, title: data.title, start: data.start, end: data.end, color: data.color, nomeLaboratorio: data.nomeLaboratorio, professorNome: data.professorNome, usuarioNome: data.usuarioNome, usuarioEmail: data.usuarioEmail}, true);
         });
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
       }
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
      relativeTime:{future:"em %s",past:"%s atrás",s:"poucos segundos",ss:"%d segundos",m:"um minuto",mm:"%d minutos",h:"uma hora",hh:"%d horas",d:"um dia",dd:"%d dias",M:"um mÃªs",MM:"%d meses",y:"um ano",yy:"%d anos"},
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
      hiddenDays: [0],
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
          $('#ModalEdit #usuario').val(event.usuarioNome);
          $('#ModalEdit #email').val(event.usuarioEmail);
          $('#ModalEdit #professor').val(event.professorNome);
          $('#ModalEdit #laboratorio').val(event.nomeLaboratorio);
          $('#ModalEdit #horaInicio').val(event.start);
          $('#ModalEdit #horaFim').val(event.end);
          $('#ModalEdit #situacao').val(event.situacao);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position
				edit(event);
			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
				edit(event);
			}
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
  		Event = [];
  		Event[0] = id;
  		Event[1] = start;
  		Event[2] = end;
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
