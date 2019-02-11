<!DOCTYPE html>
<html lang="pt">
<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['usuario']['nivel'] == 1) {
  header('Location: menuUser.php');
}if(isset($_SESSION['usuario']) && $_SESSION['usuario']['nivel'] == 2) {
  header ('Location: menuAdmin.php');
}
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>GerLabs</title>
  <!-- Bootstrap core CSS-->
  <link href="/modelo/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="/modelo/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="/modelo/assets/css/sb-admin.css" rel="stylesheet">
</head>

<body style="background-color: #080808">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="menuAdmin.php">GerLabs</a>
  </nav>
  <div class="container">
    <div class="col-md-12 row" style="margin-top: 15%">
      <div class="col-md-7 col-sm-12 text-center text-md-left ">
        <font color="white">
        <h1 class="alt-h0 text-white lh-condensed-ultra mb-3 text-center" style="font-size: 64px; font-family: Roboto">Construído pensando em você!</h1>
        </font>
        <font color="#c0c0c0">
          <p align='justify' class="alt-lead mb-4" style="font-size: 26px; font-family: Roboto">
            <strong>GerLabs</strong> é uma plataforma de gerência de laboratórios que busca facilitar as suas reservas. Com uma interface intuitiva, você pode solicitar, alterar ou excluir as suas reservas de laboratórios rápido e facilmente.</p>
          </p>
        </font>
      </div>
      <div class="mx-auto col-sm-8 col-md-5 hide-sm">
        <div class="card card-login" style="height: 20rem;">
          <div class="card-header block">Login</div>
          <div class="card-body">
            <form action="../route/listar.php" method="POST">
              <input type="hidden" name="acao" value="logarUsuario">
              <div class="form-group">
                <label class="sr-only">Usuario</label>
                <input class="form-control" id="usuario" name="usuario" type="text" required="" placeholder="Enter Login">
              </div>
              <div class="form-group">
                <label class="sr-only">Senha</label>
                <input class="form-control" id="password" name="password" type="password" required="" placeholder="Password">
              </div>
              <button class="btn btn-primary btn-block" type="submit" id="entrarUsuario" >Login</button>
            </form>
            <div class="text-center">
              <a class="d-block small mt-3" href="cadastrarUsuario.php">Criar uma conta</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="/modelo/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/modelo/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="/modelo/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
