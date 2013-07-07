<?php

/**
 * @package HELPERS 
 */
class TToolBarHelper {

    private $iconMap;
    private static $instancia = null;
    private $_security;

    /*
     * ACTFactory::getInstancia
     * @package HELPERS
     * @param Void
     * @return Objeto ACTFactory
     * @tutorial: Verifica se existe uma instancia do Objeto ACTFactory, caso contrario
     * da um new e retorna o objeto
     */

    public static function getInstancia() {
        if (self::$instancia == null) {
            self::$instancia = new TToolBarHelper();
        }
        return self::$instancia;
    }

    /*
     * ACTFactory::__clone
     *
     * @package HELPERS
     * @param Void
     * @return Null
     * @tutorial: Impede que este objeto seja clonado
     * @exception: Clone nao e permitido.
     */

    public function __clone() {
        trigger_error('Clone não é permitido.', E_USER_ERROR);
    }

    #pegar o controller que estar sendo usado
    protected function getCurrentController() {
        global $start;
        return $start->_controller;
    }

    #pegar o action que estar sendo usado
    protected function getCurrentAction() {
        global $start;
        return $start->_action;
    }    

    #pegar o action que estar sendo usado
    protected function getCurrentParamId() {
        global $start;
        $id = null;
        if($start->isParam('id')){
            $id = $start->getParam('id');
        }
        return $id;
    }    
    
    public function TToolBarHelper() {

        $this->_security = SecurityHelper::getInstancia();

        $this->iconMap = array(
            'novo' => array('icon' => 'icon-new', 'view' => false, 'action' => 'cadastrar', 'param' => true),
            'editar' => array('icon' => 'icon-copy', 'view' => false, 'action' => 'editar', 'param' => true),
            'resgatar' => array('icon' => 'icon-cloud-2', 'view' => false, 'action' => 'resgatar'),
            'excluir' => array('icon' => 'icon-remove', 'view' => false, 'action' => 'deletar'),
            'imprimir' => array('icon' => 'icon-printer', 'view' => true, 'action' => '#'),
            'localizar' => array('icon' => 'icon-search', 'view' => true, 'action' => '#')
        );
        
    }

    private function criarButton($arrayButton, $name) {
        
        $param = (  isset($arrayButton['param']) && 
                    $arrayButton['param'] === true &&
                    $this->getCurrentParamId() !== null
                ) ? '/id/'.$this->getCurrentParamId() : '';
        
        $url = ($arrayButton['action'] == '#') ? '#' : 'index.php?' . $this->getCurrentController() . '/' . $arrayButton['action'] . $param;
        
        return "<a href='{$url}' id='{$name}'>
                    <button class=\"shortcut\">
                        <span class=\"icon\">
                            <i class=\"{$arrayButton['icon']}\"></i>
                        </span>
                        <span class=\"label\">
                            " . ucfirst($name) . "
                        </span>
                    </button>
                </a>";
    }

    public function getToolBar(array $icons) {
        $toolbar = "";
        foreach ($this->iconMap as $key => $arrayButton) {
            if (!in_array($key, $icons)) {
                if ($arrayButton['view']) {
                    $toolbar.= $this->criarButton($arrayButton, $key);
                }
            } else {
                if ($this->_security->isAllowed(strtolower($this->getCurrentController() . "::" . $arrayButton['action']))) {
                    $toolbar.= $this->criarButton($arrayButton, $key);
                }
            }
        }

        return $toolbar;
    }

}

?>
