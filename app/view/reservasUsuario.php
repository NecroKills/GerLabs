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
require_once('headerMenuUser.php');
require_once('footerMenuUser.php');
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
<!--                -->
<link href='/modelo/assets/vendor/full-calendar/css/fullcalendar.css' rel='stylesheet' />
<script src="/modelo/assets/vendor/full-calendar/fullcalendar-3.6.1/lib/jquery.min.js"></script>
<script src="/modelo/assets/vendor/full-calendar/js/jquery.js"></script>
<script src="/modelo/assets/vendor/full-calendar/js/bootstrap.min.js"></script>
<script src='/modelo/assets/vendor/full-calendar/js/moment.min.js'></script>
<script src='/modelo/assets/vendor/full-calendar/fullcalendar-3.6.1/fullcalendar.min.js'></script>

<style>
.fc-day-grid-event[style*="#000"] .fc-time,
    .fc-day-grid-event[style*="#000"] .fc-title{
        color: #fff;
    }
.fc-day-grid-event[style*="#008000"] .fc-time,
    .fc-day-grid-event[style*="#008000"] .fc-title{
        color: #fff;
    }
.fc-day-grid-event[style*="#0071c5"] .fc-time,
    .fc-day-grid-event[style*="#0071c5"] .fc-title{
        color: #fff;
    }
.fc-day-grid-event[style*="#FF0000"] .fc-time,
    .fc-day-grid-event[style*="#FF0000"] .fc-title{
        color: #fff;
    }
.fc-day-grid-event[style*="eventColor"] .fc-time,
    .fc-day-grid-event[style*="eventColor"] .fc-title{
        color: #fff;
    }
</style>

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
         'acao': 'buscarReservasUsuario',
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
    buttonText:{month:"Mês",week:"Semana",day:"Dia"},
    allDayText:"dia inteiro",

      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'listDay, listWeek,listMonth'
      },
      defaultDate: new Date(),
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
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
      ]
    });

  });

</script>
