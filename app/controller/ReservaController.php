<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('../model/Reserva.php');

class ReservaController {

  private $reserva;

  public function __construct()
  {
    $this->reserva = new Reserva();
  }

  public function buscarEventos() {
      return $this->reserva->listarEventos();
  }

  public function buscarSolicitacoesEventos() {
      return $this->reserva->listarSolicitacoesEventos();
  }

  public function getDatas()
  {
    return $this->reserva->getDatas((int) $_POST['laboratorio']);
  }

  public function getSolicitacoesDatas()
  {
    return $this->reserva->getSolicitacoesDatas((int) $_POST['laboratorio']);
  }

  public function getReservasUsuario()
  {
    return $this->reserva->getReservasUsuario((int) $_POST['laboratorio']);
  }


  public function cadastrar()
  {
    $dados = $_POST['reserva'];
    // caso não selecionar o laboratorio
    if ($dados["laboratorios_id"] == 0) {
      return ["success" => null, "text" => "Para realizar uma reserva, selecione um laboratorio!"];
    }

    // convertendo data/hora
    $data = explode("-", $dados["start"]);
    $dados["start"] = $data[2]."-".$data[1]."-".$data[0]." ".$dados["hrinicio"].":00";
    $dados["end"] = $data[2]."-".$data[1]."-".$data[0]." ".$dados["hrfim"].":00";
    // apagando dados hrinicio e hrfim
    unset($dados["hrinicio"]);
    unset($dados["hrfim"]);

    // caso a hora de inicio for maior que a hora de fim
    if ($dados["start"] > $dados["end"] == true) {
      return ["success" => true, "text" => "Hora de inicio não pode ser maior que hora de fim!"];
    }
    // Buscando reserva com a mesma data, mesmo horário e mesmo laboratório;
    if($this->reserva->getDataHoraLab($dados["start"], $dados["end"], $dados["laboratorios_id"]) == false) {
      return ["success" => false, "text" => "Já existe uma reserva"];
    } else {
      if($this->reserva->cadastrar($dados)) {
        return ["success" => true, "text" => "Reserva cadastrada com sucesso!"];
      } else {
        return ["success" => false, "text" => "Erro ao cadastrar a reserva"];
        }
      }
    }

  public function editarReserva()
  {
    $dados = $_POST['editar'];
      if (isset($dados["delete"]) && isset($dados["id"])){
        if ($this->reserva->excluirReserva($dados) == true) {
          return ["success" => true, "text" => "Reserva excluida com sucesso!"];
        }
          return ["success" => false, "text" => "Erro ao excluida reserva"];
      }elseif (isset($dados["title"]) && isset($dados["color"]) && isset($dados["id"])){
        if ($this->reserva->editarReserva($dados) == true) {
          return ["success" => true, "text" => "Reserva editada com sucesso!"];
        }
          return ["success" => false, "text" => "Erro ao editar reserva"];
      }
  }

  public function editarReservaUsuario()
  {
    $dados = $_POST['editar'];
      if (isset($dados["delete"]) && isset($dados["id"])){
        if ($this->reserva->excluirReservaUsuario($dados) == false) {
          return ["success" => false, "text" => "Reserva excluida com sucesso!"];
        }
          return ["success" => true, "text" => "Erro! Você não pode excluida reserva de outro usuario!"];
      }elseif (isset($dados["title"]) && isset($dados["color"]) && isset($dados["id"])){
        if ($this->reserva->editarReservaUsuario($dados) == true) {
          return ["success" => true, "text" => "Reserva editada com sucesso!"];
        }
          return ["success" => false, "text" => "Erro! Você não pode editar reserva de outro usuario!"];
      }
  }


  public function editarDataReserva()
  {
    $dados = $_POST['Event'];

    if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
      $id = $_POST['Event'][0];
    	$start = $_POST['Event'][1];
    	$end = $_POST['Event'][2];
      $laboratorios_id = $_POST['Event'][3];

      if($this->reserva->getDataHoraLab($start, $end, $laboratorios_id) == false) {
        return ["success" => false, "text" => "Já existe uma reserva"];
      }

      if ($this->reserva->editarDataReserva($dados) == true) {
        return ["success" => true, "text" => "Reserva realocada com sucesso!"];
      }
        return ["success" => false, "text" => "Erro ao realocar reserva"];
    }
  }

  public function editarStatusReserva()
  {
    $dados = $_POST['editar'];
    if (isset($dados["delete"]) && isset($dados["id"])){
      if ($this->reserva->excluirReserva($dados) == true) {
        return ["success" => true, "text" => "Reserva excluida com sucesso!"];
      }
        return ["success" => false, "text" => "Erro ao excluida reserva"];
    }elseif (isset($dados["title"]) && isset($dados["color"]) && isset($dados["situacao"]) && isset($dados["id"])){
      if ($this->reserva->editarStatusReserva($dados) == true) {
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

            // convertendo data/hora
            $dataInicio = explode(" ", $dados["horaInicio"]);
            $dataFim = explode(" ", $dados["horaFim"]);
            $dados["horaInicio"] = $dataInicio[2]."-".$dataInicio[1]."-".$dataInicio[3]." ".$dataInicio[4];
            $dados["horaFim"] = $dataFim[2]."-".$dataFim[1]."-".$dataFim[3]." ".$dataFim[4];

            $email = $dados["email"];
            $nome = $dados["usuario"];
            $titulo = $dados["title"];
            $horaInicio = $dados["horaInicio"];
            $horaFim = $dados["horaFim"];

            if ($dados["situacao"] == 1) {
              $mail->addAddress($email);
              $mail->isHTML(true);                                  // Set email format to HTML
              $mail->Subject = "Notificação Gerlabs: Situação da Reserva";
              $mail->Body = "Olá, <strong>$nome!</strong> <p> Sua reserva <strong>($titulo)</strong>, solicitada na data/horario ($horaInicio) até ($horaFim) foi aprovada!</p> <p>Att.</p>";
              $mail->send();
              return ["success" => true, "text" => "Reserva editada com sucesso!"];
            }else{
              $mail->addAddress($email);
              $mail->isHTML(true);                                  // Set email format to HTML
              $mail->Subject = "Notificação Gerlabs: Situação da Reserva";
              $mail->Body    = "Olá, <strong>$nome!</strong> <p> Sua reserva <strong>($titulo)</strong>, solicitada na data/horario ($horaInicio) até ($horaFim) foi recusada!</p> <p>Att.</p>";
              $mail->send();
              return ["success" => true, "text" => "Reserva editada com sucesso!"];
            }
          } catch (Exception $e) {
              echo 'A mensagem não pôde ser enviada.';
              echo 'Erro do remetente: ' . $mail->ErrorInfo;
          }
      }
        return ["success" => false, "text" => "Erro ao editar reserva"];
    }
  }

  public function buscarProfessor()
  {
    return $this->reserva->listarProfessor();
  }

  public function cadastrarProfessor()
  {
    $dados = $_POST['professor'];

    if($this->reserva->addProfessor($dados)) {
      return ["success" => true, "text" => "Professor cadastrado com sucesso no banco de dados"];
    }else{
      return ["success" => false, "text" => "Erro ao cadastrar professor no banco de dados"];
    }
  }

  }
