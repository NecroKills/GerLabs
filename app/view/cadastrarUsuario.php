<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Cadastrar</title>
  <!-- Bootstrap core CSS-->
  <link href="/modelo/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="/modelo/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="/modelo/assets/css/sb-admin.css" rel="stylesheet">
</head>

<style type="text/css">
label {
    display: block;
    margin-top: 10px;
}
label.error {
    float: none;
    color: red;
    margin: 0 .5em 0 0;
    vertical-align: top;
    font-size: 12px
}
</style>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Cadastrar conta</div>
      <div class="card-body">
        <form id="formularioCadastro" onSubmit="return validar(this);">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Login</label>
                <input class="form-control" name="usuario[login]" id="login" type="text" aria-describedby="loginHelp" placeholder="Enter login">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Nome</label>
                <input class="form-control" name="usuario[nomeSolicitante]" id="nomeSolicitante" type="text" aria-describedby="nameHelp" placeholder="Enter nome">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input class="form-control" name="usuario[email]" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Senha</label>
                <input class="form-control" name="usuario[password]" id="Password" type="password" placeholder="Password">
              </div>
              <!-- <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input class="form-control" id="ConfirmPassword" type="password" placeholder="Confirm password">
              </div> -->
            </div>
          </div>
          <input class="btn btn-primary btn-block" onclick="criarUsuario()" type="button" name="enviar" value="Registrar" >
            <input type="hidden" name="acao" value="criarUsuario">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Pagina inicial</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/modelo/assets/vendor/jquery/jquery.js"></script>
  <script src="/modelo/assets/vendor/jquery-validate/jquery.validate.js"></script>
  <script src="/modelo/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/modelo/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<script>

  function criarUsuario()
  {
    var formDados = $('#formularioCadastro').serialize();
    $.ajax({
     url: '../route/criar.php',
     type: "POST",
     dataType: "json",
     data: formDados,
     success: function(cadastrar){
       if(cadastrar.success == true) {
         alert(cadastrar.text);
         document.location='../view/index.php';
       } else {
         alert(cadastrar.text);
       }
     }
    });
  }

  $(document).ready( function() {
        $("#formularioCadastro").validate({
            rules: {
              'usuario[login]': {required: true},
              'usuario[nomeSolicitante]': {required: true},
              'usuario[email]': {required: true, email: true},
              'usuario[password]': {required: true},
            },
            messages: {
              'usuario[login]': {required: "Digite o seu usuario"},
              'usuario[nomeSolicitante]': {required: "Digite seu nome"},
              'usuario[email]': {required: "Digite o seu e-mail"},
              'usuario[password]': {required: "Digite sua senha"}
            }
        });
    });
</script>

</body>
</html>
