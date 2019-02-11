<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('../model/Usuario.php');

class UsuarioController {

  public function cadastrarUsuario()
   {
     $dados = $_POST['usuario'];
     $password = $dados['password'];
     $senha = MD5($password);
     $dados['password'] = $senha;

     $usuario = new Usuario();
     $login = $dados['login'];
     if($usuario->verificaLogin($login) == true) {
       return ["success" => true, "text" => "Login já em uso, tente outro!"];
     } else {
       if($usuario->inserir($dados)) {
          // PhpMailer para enviar emails
         require '../../assets/vendor/PHPMailer/src/PHPMailer.php';
         require '../../assets/vendor/PHPMailer/src/SMTP.php';
         require '../../assets/vendor/PHPMailer/src/Exception.php';
         $mail = new PHPMailer(true);                       // Passing `true` enables exceptions
         try {                 //Server settings
             $mail->setLanguage('pt_br', 'PHPMailer/language/directory/');
             $mail->CharSet = "utf8";
             $mail->isSMTP();                                     // Set mailer to use SMTP
             $mail->Host = 'pleskns1.lockhost.com.br';            // Specify main and backup SMTP servers
             $mail->SMTPAuth = true;                              // Enable SMTP authentication
             $mail->Username = 'gerlabs@gerlabs.ga';              // SMTP username
             //
             $mail->Port = 587;                                  // TCP port to connect to
             $mail->setFrom('gerlabs@gerlabs.ga', 'Gerlabs');
             $email = $dados["email"];
             $nome = $dados["nomeSolicitante"];
             $situacao = 0;
             if ($situacao == 0) {
               $mail->addAddress($email);
               $mail->isHTML(true);                                  // Set email format to HTML
               $mail->Subject = "Notificação Gerlabs: Cadastro realizado com sucesso!";
               $mail->Body = "Olá, <strong>$nome!</strong> <p> Seu cadastro foi realizado com sucesso!, Aguarde a aprovação do Administrador!</p> <p>Att.</p>";
               $mail->send();
               $mail->addAddress('god.dark.rick@hotmail.com', 'Gerlabs');
               $mail->Subject = "Notificação Gerlabs: Novo cadastro no GerLabs!";
               $mail->Body = "Olá, <strong>$nome!</strong> <p> Existe um novo cadastro inativo no GerLabs.</p> <p>Att.</p>";
               $mail->send();
               return ["success" => true, "text" => "Usuário criado com sucesso! Aguardando a aprovação do administrador!"];
             }
           } catch (Exception $e) {
               echo 'A mensagem não pôde ser enviada.';
               echo 'Erro do remetente: ' . $mail->ErrorInfo;
           }
       } else {
         return ["success" => false, "text" => "Erro ao cadastrar usuario!"];
         }
     }
   }

  #------------------ login ----------------
  public function logar() {
    $model = new Usuario();
    $resultado = $model->logar($_POST['usuario'], $_POST['password']);
    if($resultado == false){
      $message = "Combinação de usuário e senha incorretos";
      echo "<script type='text/javascript'>alert('$message');history.back();</script>";
    }else{
      session_start();
      $_SESSION['usuario'] = $resultado;
      header("Location: ../view/index.php");
      }
    }

#------------------ Verificação ----------------
  public function verificaAtivo()
  {
    $model = new Usuario();
    $resultado = $model->verificaAtivo($_POST['usuario']);
    if(!$resultado){
      $message = "Usuario inativo ou aguardando aprovação";
      echo "<script type='text/javascript'>alert('$message');history.back();</script>";
    }
    if($resultado){
      include_once('/UsuarioController.php');
      $login = new UsuarioController();
      $verifica = $login->logar($_POST['usuario'], $_POST['password']);
    }
      return 'Combinação de usuário e senha incorretos';
    }

  public function logout()
  {
    session_start();
    unset($_SESSION['usuario']);
  }

  #seleciona todos os usuarios cadastrados no sistema
  public function getAll()
  {
      $usuario = new Usuario();
      return $usuario->getAll();
  }

  public function buscar()
  {
      $usuario = new Usuario();
      $id = $_POST['user_id'];
      return $usuario->buscar($id);
  }

  public function excluir()
  {
    $usuario = new Usuario();
    $id = $_POST['user_id'];
    return $usuario->excluir($id);
  }
  public function atualizar()
  {
    $usuario = new Usuario();
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email_post = $_POST['email'];
    $situacao = $_POST['situacao'];
    $nivel = $_POST['nivel'];
    if ($usuario->atualizar($id, $nome, $email_post, $situacao, $nivel)) {
          // PhpMailer para enviar emails
         require '../../assets/vendor/PHPMailer/src/PHPMailer.php';
         require '../../assets/vendor/PHPMailer/src/SMTP.php';
         require '../../assets/vendor/PHPMailer/src/Exception.php';
         $mail = new PHPMailer(true);                       // Passing `true` enables exceptions
         try {                 //Server settings
             $mail->setLanguage('pt_br', 'PHPMailer/language/directory/');
             $mail->CharSet = "utf8";
             $mail->isSMTP();                                     // Set mailer to use SMTP
             $mail->Host = 'pleskns1.lockhost.com.br';            // Specify main and backup SMTP servers
             $mail->SMTPAuth = true;                              // Enable SMTP authentication
             $mail->Username = 'gerlabs@gerlabs.ga';              // SMTP username
             //
             $mail->Port = 587;                                  // TCP port to connect to
             $mail->setFrom('gerlabs@gerlabs.ga', 'Gerlabs');
             if ($situacao == 1) {
              $mail->addAddress($email_post);
              $mail->isHTML(true);                                  // Set email format to HTML
              $mail->Subject = "Notificação Gerlabs: Situação da Reserva";
              $mail->Body    = "Olá, <strong>$nome!</strong> <p> Seu cadastro foi ativado pelo administrador!</p> <p>Att.</p>";
              $mail->send();
             }elseif ($situacao == 2){
                $mail->addAddress($email_post);
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = "Notificação Gerlabs: Situação da Reserva";
                $mail->Body    = "Olá, <strong>$nome!</strong> <p> Seu cadastro foi recusado pelo administrador!</p> <p>Att.</p>";
                $mail->send();
              }
           } catch (Exception $e) {
               echo 'A mensagem não pôde ser enviada.';
               echo 'Erro do remetente: ' . $mail->ErrorInfo;
           }
      return "Usuário editado";
    }
      return "Sem modificações no usuário";
  }

}
