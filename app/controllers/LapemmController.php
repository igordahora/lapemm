<?php

class LapemmController extends TLapemm {
    
    # Pagina principal
    public function index() {
        $this->REDIRECT->goToAction("quemsomos");
    }

    /**
     * Pagina LAPEMM - Quem Somos
     */
    public function quemsomos() {
        # Title
        $this->HTML->setTitle('Lapemm - Quem somos');

        # CSS
        $this->HTML->addCss(PATH_CSS_URL . $this->_controller . "/" . $this->_action . ".css");

        # JCarousel
        $this->HTML->addJavaScript(PATH_PLUGIN_URL . 'JCarousel/jquery.jcarousel.min.js');
        $this->HTML->addCss(PATH_PLUGIN_URL . 'JCarousel/skins/tango/skin.css');

        # JS
        $this->HTML->addCss(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        # Linha de Pesquisa
        $objLinhaDePesquisaLogic = new LinhaDePesquisaLogic();
        
        # Lista de linha de pesquisa
        $this->addDados('listLinhaDePesquisa', $objLinhaDePesquisaLogic->listar());
        unset($objLinhaDePesquisaLogic);
        
        $this->TView('quemsomos');
    }

    /**
     * Pagina LAPEMM - Grupos
     */
    public function grupo() {

        # Title
        $this->HTML->setTitle('Lapemm - Grupo');

        # CSS
        $this->HTML->addCss(PATH_CSS_URL . $this->_controller . "/" . $this->_action . ".css");

        # yoxview
        $this->HTML->addJavaScript(PATH_PLUGIN_URL . 'yoxview/yoxview-init.js');

        # JS
        $this->HTML->addCss(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        $this->TView('grupo');
    }

    /**
     * 
     * Exibir pagina de projetos
     */
    public function projetos() {
        
        # Title
        $this->HTML->setTitle("Lapemm - Projetos");

        # CSS
        $this->HTML->addCss(PATH_CSS_URL . $this->_controller . "/" . $this->_action . ".css");

        # Iniciar class ProjetosModel
//        $projetosModel = new ProjetosModel();
//        $dadosConteudo['projetos'] = $projetosModel->exibirListaDeProjetos();

        $this->TView('projetos');
    }

}

?>