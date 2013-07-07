<?php

class SecurityController extends TWin8 {

    private $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new SecurityLogic();
    }

    public function logar() {

        $flag = $this->logic->logar($_POST);

        if ($flag === 0) {
            $this->REDIRECT->goToController('Principal');
        } else {
            $this->REDIRECT->setUrlParameter('error', $flag);
            $this->REDIRECT->goToControllerAction('Index', 'logon');
        }
        
    }

    public function deslogar() {
        $this->SECURITY->destruirSessao();
        $this->REDIRECT->goToControllerAction('Index', 'logon');
    }

    public function recuperar() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $objUsuarioLogic = new UsuarioLogic();
            $objUsuario = $objUsuarioLogic->obter("email = '{$_POST['email']}'");

            if (!$objUsuario) {
                $this->REDIRECT->goToControllerAction('Index', 'resgatar');
            } else {

                $tokenHelper = new TokenHelper();
                $token = $tokenHelper->gerarToken($objUsuario->getId());
                $senhaAutenticacao = SecurityHelper::gerarSenhaRandomica();

                $mensagem = '<h2>Dados para recuperação de senha.</h2>';
                $mensagem .= 'Senha de Confirmação: <b>' . $senhaAutenticacao . '</b><br>';
                $mensagem .= "Link: <a href= '" . PATH_URL . "index.php?Security/alterarSenha/token/" . $token . "'>Clique para iniciar o processo de recuperação de senha!!!</a><br>";
                $mensagem .= "Link Alternativo:  <a href= '" . PATH_URL . "index.php?Security/alterarSenha/token/" . $token . "'>" . PATH_URL . "index.php?Security/alterarSenha/token/" . $token . "</a><br>";

                # Iniciar logic de Token
                $tokenLogic = new TokenLogic();

                # Excluir todos os token que a data de validade for menor que a data atual
                $excluir = array();
                $excluir['time_atual'] = time();
                $tokenLogic->excluir('data_validade < :time_atual', $excluir);
                unset($excluir);

                # Excluir todos os token do usuario atual          
                $id_ref = $tokenHelper->criptografar($objUsuario->getId());
                $tokenLogic->excluir("des_token like '{$id_ref}%'");
                unset($id_ref);
                unset($tokenHelper);

                # DATA E HORA QUE O TOKEN VAI ESPIRAR
                $TOKEN['dataValidade'] = time() + (1 * 24 * 60 * 60);
                # TOKEN
                $TOKEN['token'] = $token;
                # SENHA DE AUTENTICACAO
                $TOKEN['senhaAutenticacao'] = $senhaAutenticacao;

                # Salvar Token
                $salvar = $tokenLogic->salvar($TOKEN);

                if ($salvar) {

                    $emailHelper = new EmailHelper();
                    $emailHelper->addDestinatario($objUsuario->getEmail());
                    $emailHelper->mail('Solicitação de recuperação de senha - ' . NAME_SIS, $mensagem);
                    $enviar = $emailHelper->sendMail();

                    if (!$enviar) {
                        
                        # Excluir todos os token do usuario atual          
                        $tokenLogic->excluir("des_token = '{$token}'");

                        $this->REDIRECT->setUrlParameter('feedback', 3);
                        $this->REDIRECT->goToControllerAction('Index', 'resgatar');
                        
                    } else {
                        $this->REDIRECT->setUrlParameter('feedback', 1);
                        $this->REDIRECT->goToControllerAction('Index', 'logon');
                    }
                    
                } else {
                    $this->REDIRECT->setUrlParameter('feedback', 3);
                    $this->REDIRECT->goToControllerAction('Index', 'resgatar');
                }
                
            }
            
        } else {
            $this->REDIRECT->goToControllerAction('Index', 'logon');
        }
    }

    public function alterarSenha() {

        if (!$this->isParam('token')) {
            $this->REDIRECT->goToControllerAction("Errors", "HTTP_404");
        } else {

            # Iniciar logic de Token
            $tokenLogic = new TokenLogic();
            #obter token
            $token = $tokenLogic->obter("des_token = '{$this->getParam('token')}'");

            if (!$token) {
                $this->REDIRECT->goToControllerAction("Errors", "HTTP_404");
            } else {

                if ($token->getDataValidade() < time() || $token->getTentativas() === 3) {
                    $tokenLogic->excluirPorId($token->getId());
                    $this->REDIRECT->goToControllerAction("Errors", "HTTP_404");
                }
            }

            $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.validate.js');
            $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.pstrength-min.1.2.js');
            $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");
            $this->addDados('token', $this->getParam('token'));
            $tentavivas = ($token->getTentativas() > 0) ? "Nº de Tentativas [{$token->getTentativas()}]" : '';
            $this->addDados('tentativas', $tentavivas);
            $this->TPageSecondary('alteraSenha');
        }
    }

    public function salvarSenha() {

        unset($_POST['des_senha_conf']);

        # Iniciar logic de Token
        $tokenLogic = new TokenLogic();
        #obter token
        $token = $tokenLogic->obter("des_token = '{$_POST['token']}'");

        if (!$token) {
            $this->REDIRECT->goToControllerAction("Errors", "HTTP_404");
        } else {

            if ($token->getDataValidade() < time() || $token->getTentativas() === 3) {
                $tokenLogic->excluirPorId($token->getId());
                $this->REDIRECT->goToControllerAction("Errors", "HTTP_404");
            } else {

                if ($token->getSenhaAutenticacao() == md5($_POST['senhaAutenticacao'])) {

                    $tokenHelper = new TokenHelper();
                    $tokenHelper->decryptToken($_POST['token']);

                    # Atualizar usuario
                    $usuario['id'] = $tokenHelper->getId();
                    $usuario['senha'] = $_POST['senha'];
                    $usuario['idUsuarioAtualizador'] = $tokenHelper->getId();
                    $usuario['dataAtualizacao'] = time();

                    $objUsuarioLogic = new UsuarioLogic();
                    $salvar = $objUsuarioLogic->salvar($usuario);
                    unset($usuario);

                    if (!$salvar) {
                        $this->REDIRECT->goToAction('alterarSenha');
                    } else {

                        # Excluir todos os token que a data de validade for menor que a data atual
                        $excluir = array();
                        $excluir['time_atual'] = time();
                        $tokenLogic->excluir('data_validade < :time_atual', $excluir);
                        unset($excluir);

                        # Excluir todos os token do usuario atual          
                        $excluir = array();
                        $excluir['token'] = $_POST['token'];
                        $tokenLogic->excluir('des_token = :token', $excluir);
                        unset($excluir);

                        $objVUsuarioLogic = new UsuarioLogic();
                        $objUsuario = $objVUsuarioLogic->obterPorId($tokenHelper->getId());
                        unset($objVUsuarioLogic);

                        $emailHelper = new EmailHelper();
                        $emailHelper->addDestinatario($objUsuario->getEmail());
                        unset($objUsuario);

                        # Mensagem de confirmacao
                        $mensagem = '<b>Senha modificada com sucesso!!!</b><br>';
                        $mensagem .= "Para ser redirecionado ao sistema <a href='" . PATH_URL . "' >" . NAME_SIS . '</a> acesse o link e efetuei o logon.';

                        $emailHelper->mail('Confirmação de mudança de senha - ' . NAME_SIS, $mensagem);
                        unset($mensagem);
                        $emailHelper->sendMail();

                        $this->REDIRECT->setUrlParameter('feedback', 2);
                        $this->REDIRECT->goToControllerAction('Index', 'logon');
                    }
                } else {
                    $token->setTentativas($token->getTentativas() + 1);
                    $tokenLogic->salvar($token);
                    $this->REDIRECT->setUrlParameter('token', $_POST['token']);
                    $this->REDIRECT->setUrlParameter('feedback', 3);
                    $this->REDIRECT->goToAction('alterarSenha');
                }
            }
        }
    }

}

?>