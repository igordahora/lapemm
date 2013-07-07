<?php

class EmailHelper {
    
    private $PHPMailer;

    public function __construct(Array $config = null) {
        require_once(PATH_SYSTEM."componentes/phpmailer/class.phpmailer.php"); // Certifique-se de que o caminho está certo.                
        $this->PHPMailer = new PHPMailer();
        $this->config($config);
    }

    private function config(Array $config = null){
        
        if($config != null){
            $PhpMailer = $config;
            $nome_remetente = $PhpMailer['nome_remetente'];
        }else{
            $ini = parse_ini_file('system/config/config.ini',true);
            $PhpMailer = $ini['PhpMailer'];
            $nome_remetente = $ini['application']['nome']." - ". $ini['application']['descricao'];
        }
        
        $smtp = $PhpMailer['smtp'];
        $smtp_port = $PhpMailer['smtp_port'];
        $smtp_secure = $PhpMailer['smtp_secure'];
        $username = $PhpMailer['username'];
        $password = $PhpMailer['password'];
        $remetente = $PhpMailer['remetente'];
         
        
        $this->PHPMailer->SetLanguage("br", PATH_SYSTEM."componentes/phpmailer/"); // Linguagem
        $this->PHPMailer->SMTP_PORT = $smtp_port; // Porta do SMTP
        $this->PHPMailer->SMTPSecure = $smtp_secure; // Tipo de comunicação segura
        
        $this->PHPMailer->IsSMTP();
        $this->PHPMailer->Host = $smtp;  // Endereço do servidor SMTP
        $this->PHPMailer->SMTPAuth = true; // Requer autenticação?
        $this->PHPMailer->Username = $username; // Usuário SMTP
        $this->PHPMailer->Password = $password; // Senha do usuário SMTP

        $this->PHPMailer->From = $remetente; // E-mail do remetente
        $this->PHPMailer->FromName = $nome_remetente; // Nome do remetente    
        $this->PHPMailer->IsHTML(true); // Define que o e-mail será enviado como HTML
        
        if(isset($PhpMailer['CharSet'])){
            $this->PHPMailer->CharSet = 'iso-8859-1'; // Definir charset da mensagem (Opcional)
        }
        
    }

    public function addDestinatario($destinatario, $nome = ''){
        $this->PHPMailer->AddAddress($destinatario, $nome);
        return $this;
    }

    public function addDestinatarioCopia($destinatario, $nome = ''){
        $this->PHPMailer->AddBCC($destinatario, $nome);
        return $this;
    }
    
    public function addDestinatarioCopiaOculta($destinatario, $nome = ''){
        $this->PHPMailer->AddAddress($destinatario, $nome);
        return $this;
    }
    
    public function addAnexo($path_anexo, $novo_nome = ''){
        $this->PHPMailer->AddAttachment($path_anexo, $novo_nome);  // Insere um anexo
        return $this;
    }
    
    public function mail($assunto, $mensagem){
        $this->PHPMailer->Subject = $assunto;
        $this->PHPMailer->Body = $mensagem;
        return $this;
    }

    public function sendMail() {
        
        $send = $this->PHPMailer->Send(); 
        
        // Limpa os destinatários e os anexos
        $this->PHPMailer->ClearAllRecipients();
        $this->PHPMailer->ClearAttachments();

        if (!$send) {
            $erro = "Erro: " . utf8_decode($this->PHPMailer->ErrorInfo);
            return $erro;
        } else {
            return true;
        }
        
    }

}

?>