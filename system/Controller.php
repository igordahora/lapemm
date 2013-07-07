<?php

class Controller extends System {

    public $REDIRECT;
    private $DADOS;

    public function __construct() {
        parent::__construct();
        $this->REDIRECT = new RedirectorHelper();
        $this->DADOS = null;
    }

    public function init() {}
    
    public function addDados($name, $value){
        $this->DADOS[$name] = $value;
    }
    
    public function view($nome) {
        if (is_array($this->DADOS) && count($this->DADOS) > 0) {
            extract($this->DADOS, EXTR_PREFIX_ALL, 'view');
        }

        $path = VIEWS . $this->_controller . "/" . $nome . '.phtml';

        if (!file_exists($path)) {
            $this->REDIRECT->goToControllerAction("Errors", "VIEW_404");
        }

        return require_once ( $path );
    }

}

?>
