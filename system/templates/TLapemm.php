<?php

/**
 * Description of Win8
 * @author igor
 */
class TLapemm extends Controller {

    public $HTML;
    public $NAVIGATOR;

    public function __construct() {
        parent::__construct();
        $this->HTML = new THtmlHelper();
        $this->NAVIGATOR = TBrowserHelper::getBrowser();
        define('PATH_TEMPLATE_URL', PATH_WEBFILES_URL . 'templates/' . __CLASS__ . "/");
        define('PATH_PLUGIN_URL', PATH_WEBFILES_URL . 'plugin/');
        define("PATH_VIEW_TEMPLATE_CORE", VIEWS . "core/");
    }

    public function init() {

        parent::init();

        # Definir icon padrão do sistema
        $this->HTML->setIcon(PATH_IMAGE_URL . "favicon.ico");

        # Adicionar JQuery
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery-1.8.2.min.js", true); // 1 a entrar

        # Adiconar css      
        $this->HTML->addCss(PATH_TEMPLATE_URL . 'css/menu-rodape.css', true); // 7 a entrar
        $this->HTML->addCss(PATH_TEMPLATE_URL . 'css/contato.css', true); // 6 a entrar
        $this->HTML->addCss(PATH_TEMPLATE_URL . 'css/mapa-site.css', true); // 5 a entrar
        $this->HTML->addCss(PATH_TEMPLATE_URL . 'css/rodape.css', true); // 4 a entrar
        $this->HTML->addCss(PATH_TEMPLATE_URL . 'css/menu.css', true); // 3 a entrar
        $this->HTML->addCss(PATH_TEMPLATE_URL . 'css/topo.css', true); // 2 a entrar
        $this->HTML->addCss(PATH_TEMPLATE_URL . 'css/template.css', true); // 1 a entrar
    }

    public function TView($nome) {

        # Inicia o buffer
        ob_start();

        #cabeçalho
        require_once PATH_VIEW_TEMPLATE_CORE . "header.phtml";
        # Incluir view no tamplate
        $this->view($nome);
        #Rodapé
        require_once PATH_VIEW_TEMPLATE_CORE . "footer.phtml";

        # Pegar view e aloca numa variavel
        $content = ob_get_clean();

        # Adicionar a view ao Body
        $this->HTML->setBodyContent($content);

        # Imprime o HTML
        echo $this->HTML->getHtml();
    }

}

?>
