<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>GerLabs - Menu administrador</title>
  <!-- Bootstrap core CSS-->
  <!-- <link href="/modelo/assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet"> -->
  <link href="/modelo/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="/modelo/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="/modelo/assets/vendor/select2/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/modelo/assets/vendor/multiselect/css/bootstrap-multiselect.css" type="text/css"/>
  <!-- Custom styles for this template-->
  <link href="/modelo/assets/css/sb-admin.css" rel="stylesheet">
  <link href='/modelo/assets/vendor/full-calendar/css/fullcalendar.css' rel='stylesheet' />
</head>

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

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="menuAdmin.php">GerLabs</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right">
           <a class="nav-link" href="menuAdmin.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#usuarioCollapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Usuário</span>
          </a>
          <ul class="sidenav-second-level collapse" id="usuarioCollapseComponents">
            <li>
              <a href="buscarUsuario.php">
                <i class="fa fa-search"> Buscar</i>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#ReservaCollapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Reserva</span>
          </a>
          <ul class="sidenav-second-level collapse" id="ReservaCollapseComponents">
            <li>
              <a href="solicitarReserva.php" class="fa fa-pencil"> Solicitações</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#laboratorioCollapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Laboratório</span>
          </a>
          <ul class="sidenav-second-level collapse" id="laboratorioCollapseComponents">
            <li>
              <a href="buscarLaboratorio.php">
                <span class="fa fa-search"> Buscar</span>
              </a>
            </li>
            <li>
              <a href="cadastrarLaboratorio.php">
                <span class="fa fa-plus"> Cadastrar</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#sistemaCollapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Sistema</span>
          </a>
          <ul class="sidenav-second-level collapse" id="sistemaCollapseComponents">
            <li>
              <a href="cadastrarAll.php">
                <span class="fa fa-plus"> Cadastrar</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Relatório</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li>
          <a class="nav-link">
            <i class="fa fa-fw fa-user"></i>Olá, <?php echo $_SESSION['usuario']['nome']; ?>!
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#logout">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
