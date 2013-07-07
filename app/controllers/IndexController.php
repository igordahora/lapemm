<?php

class IndexController extends TWin8{
    
    public function index() {
        $this->REDIRECT->goToAction('logon');
    }

    public function logon() {

        $this->HTML->setTitle("Login");
        
        # Adicionar JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "util.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "core.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller. "/" . $this->_action . ".js");

        $this->addDados('error', $this->isParam('error'));
        if ($this->isParam('error')) {
            switch ($this->getParam("error")) {
                case 1:
                    $this->addDados('message',"Perfil desativado, contate o administrador");
                    break;
                case 2:
                    $this->addDados('message',"Tentativa de login incorreta, seu login sera bloqueado após 3 tentativas");
                    break;
                case 3:
                    $this->addDados('message',"Usuário ou Senha incorretos tente novamente");
                    break;
                case 4:
                    $this->addDados('message',"Acesso bloqueado ao sistema, contate o administrador");
                    break;
                case 5:
                    $this->addDados('message',"Perfil sem privilégios de acesso ao sistema, contate o administrador");
                    break;
                case 6:
                    $this->addDados('message',"Controles de Autorização e Autenticação desativados, contate o administrador");
                    break;
                case 7:
                    $this->addDados('message',"Usuário não existe, contate o administrador");
                    break;
                default:
                    $this->addDados('message',"É constrangedor, mas, ocorreu uma falha para acessar nosso sistema, contate o administrador");
                    break;
            }
        }
        
        $feedback = ($this->isParam('feedback'))? TWin8Helper::displayFeedback($this->getParam('feedback')) : '' ;
        $this->addDados('feedback', $feedback);
               
        # Startar Template
        $this->TStart("logon");
    }
    
    public function resgatar() {
        
        # Adicionar JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "util.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "mask.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller. "/" . $this->_action . ".js");
        
        $this->TStart('resgate');
    }
    
}

?>
