<?php
require_once("bdd.php");
$sql = "SELECT id, title, start, end, color FROM events ";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Teste</title>

    <link href="/modelo/assets/vendor/full-calendar/css/bootstrap.min.css" rel="stylesheet">
    <link href='/modelo/assets/vendor/full-calendar/css/fullcalendar.css' rel='stylesheet' />
    <script src="/modelo/assets/vendor/full-calendar/js/jquery.js"></script>
    <script src="/modelo/assets/vendor/full-calendar/js/bootstrap.min.js"></script>
    <script src='/modelo/assets/vendor/full-calendar/js/moment.min.js'></script>
    <script src='/modelo/assets/vendor/full-calendar/js/fullcalendar.min.js'></script>

  </head>
  <body>
    <div class="container">
      <div class="form-group">
        <div class="form-row">
          <div class="col-md-12">
              <div id="calendar"> </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    		  <div class="modal-dialog" role="document">
    			<div class="modal-content">
    			<form class="form-horizontal" method="POST" action="addEvent.php">

    			  <div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    				<h4 class="modal-title" id="myModalLabel">Adicionar reserva</h4>
    			  </div>
    			  <div class="modal-body">

    				  <div class="form-group">
    					<label for="title" class="col-sm-2 control-label">Titulo</label>
    					<div class="col-sm-10">
    					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
    					</div>
    				  </div>
    				  <div class="form-group">
    					<label for="color" class="col-sm-2 control-label">Cor</label>
    					<div class="col-sm-10">
    					  <select name="color" class="form-control" id="color">
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
    					<label for="start" class="col-sm-2 control-label">Data/Hora de inicio</label>
    					<div class="col-sm-10">
    					  <input type="text" name="start" class="form-control" id="start" readonly>
    					</div>
    				  </div>
    				  <div class="form-group">
    					<label for="end" class="col-sm-2 control-label">Data/Hora de fim</label>
    					<div class="col-sm-10">
    					  <input type="text" name="end" class="form-control" id="end" readonly>
    					</div>
    				  </div>

    			  </div>
    			  <div class="modal-footer">
    				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    				<button type="submit" class="btn btn-primary">Reservar</button>
    			  </div>
    			</form>
    			</div>
    		  </div>
    		</div>
    		<!-- Modal -->
    		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    		  <div class="modal-dialog" role="document">
    			<div class="modal-content">
    			<form class="form-horizontal" method="POST" action="editEventTitle.php">
    			  <div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    				<h4 class="modal-title" id="myModalLabel">Editar evento</h4>
    			  </div>
    			  <div class="modal-body">

    				  <div class="form-group">
    					<label for="title" class="col-sm-2 control-label">Titulo</label>
    					<div class="col-sm-10">
    					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
    					</div>
    				  </div>
    				  <div class="form-group">
    					<label for="color" class="col-sm-2 control-label">Cor</label>
    					<div class="col-sm-10">
    					  <select name="color" class="form-control" id="color">
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
    							<label class="text-danger"><input type="checkbox"  name="delete"> Deletar evento</label>
    						  </div>
    						</div>
    					</div>

    				  <input type="hidden" name="id" class="form-control" id="id">


    			  </div>
    			  <div class="modal-footer">
    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				<button type="submit" class="btn btn-primary">Salvar alterações</button>
    			  </div>
    			</form>
    			</div>
    		  </div>
    		</div>
        </div>
        <!-- /.container -->

    	<script>

    	$(document).ready(function() {
    		$('#calendar').fullCalendar({
    			header: {
    				left: 'prev,next today',
    				center: 'title',
    				right: 'month,agendaWeek,agendaDay,listWeek'
    			},
    			defaultDate: '2017-05-28',
    			editable: true,
    			eventLimit: true, // allow "more" link when too many events
    			selectable: true,
    			selectHelper: true,
    			select: function(start, end) {

    				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
    				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
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

    		function edit(event){
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
    			 url: 'editEventDate.php',
    			 type: "POST",
    			 data: {Event:Event},
    			 success: function(rep) {
    					if(rep == 'OK'){
    						alert('Saved');
    					}else{
    						alert('Could not be saved. try again.');
    					}
    				}
    			});
    		}

    	});

    </script>
  </body>
</html>
