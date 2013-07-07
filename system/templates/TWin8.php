<?php

/**
 * Description of Win8
 * @author igor
 */
class TWin8 extends Controller {

    public $HTML;
    public $NAVIGATOR;
    public $SECURITY;
    private $FEEDBACK;

    public function __construct() {
        parent::__construct();
        $this->HTML = new THtmlHelper();
        $this->NAVIGATOR = TBrowserHelper::getBrowser();
        $this->SECURITY = SecurityHelper::getInstancia();
        define("PATH_TEMPLATE_URL", PATH_WEBFILES_URL . "templates/" . __CLASS__ . "/");
    }

    public function init() {

        parent::init();

        # Redirecionar se o Navegador for diferente do estabelecido (Firefox)
        if ($this->NAVIGATOR->browser != "FIREFOX") {
            $this->REDIRECT->goToControllerAction("Errors", "browserSupported");
        }

        # Definir icon padrão do sistema
        $this->HTML->setIcon(PATH_IMAGE_URL . "favicon.ico");

        # Definir nome da pagina
        $this->HTML->setTitle(strtoupper(NAME_SIS) . " - {$this->_controller}/{$this->_action}");

        # Adicionar JS Default
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "feedback.js", true); // 4 a entrar
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "MetroUI/tile-slider.js", true); // 3 a entrar
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.mousewheel.min.js", true); // 2 a entrar
        # Adicionar JQuery
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery-1.8.2.min.js", true); // 1 a entrar
        # Adiconar css
        $this->HTML->addCss(PATH_TEMPLATE_URL . "css/modern-responsive.css", true); //2 entrar
        $this->HTML->addCss(PATH_TEMPLATE_URL . "css/modern.css", true); //1 entrar
        # Configurar Body
        $this->HTML->setBodyAttribute('class="metrouicss"');

        $this->FEEDBACK = TFeedbackHelper::displayFeedback();
    }

    public function TStart($nome) {

        # Inicia o buffer
        ob_start();

        # Feedback
        echo $this->FEEDBACK;
        
        # Incluir view no tamplate 
        $this->view($nome);

        # Pegar view e aloca numa variavel
        $content = ob_get_clean();

        # Adicionar CSS
        $this->HTML->addCss(PATH_TEMPLATE_URL . "css/theme-dark.css");

        # Adicionar a view ao Body
        $this->HTML->setBodyContent($content);

        # Imprime o HTML
        echo $this->HTML->getHtml();
    }

    public function TMetro($nome) {

        # Inicia o buffer
        ob_start();

        # Feedback
        echo $this->FEEDBACK;

        # Incluir view no tamplate 
        $this->view($nome);

        # Pegar view e aloca numa variavel
        $content = ob_get_clean();

        # Adicionar JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "MetroUI/tile-drag.js"); // 2 a entrar
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "MetroUI/start-menu.js"); // 1 a entrar
        # Adicionar CSS
        $this->HTML->addCss(PATH_TEMPLATE_URL . "css/theme-dark.css");

        # Adicionar a view ao Body
        $this->HTML->setBodyContent($content);

        # Imprime o HTML
        echo $this->HTML->getHtml();
    }

    public function TPageSecondary($nome) {

        # Inicia o buffer
        ob_start();
        
        # Feedback
        echo $this->FEEDBACK;
        
        # Incluir view no tamplate 
        $this->view($nome);

        # Pegar view e aloca numa variavel
        $content = ob_get_clean();

        # Adicionar conteudo adicional ao body
        $content .= TWin8Helper::displayIniStart(PATH_TEMPLATE_URL . "images/principal.png");

        # Adicionar CSS
        $this->HTML->addCss(PATH_TEMPLATE_URL . "css/site.css");

        if ($this->_action == 'listar') {
            $this->HTML->addCss(PATH_TEMPLATE_URL . "css/paginacao.css");
        }

        # Adicionar a view ao Body
        $this->HTML->setBodyContent($content);

        # Imprime o HTML
        echo $this->HTML->getHtml();
    }

}

?>
