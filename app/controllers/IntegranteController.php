<?php

class IntegranteController extends TWin8 {

    private $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new IntegranteLogic();
    }

    public function index() {
        $this->REDIRECT->goToAction('listar');
    }

    public function listar() {
        $this->addDados('toolbar', TWin8Helper::displayToolBar(array('novo')));
        $integrantes = $this->logic->listar(null, 'nome', true);
        $this->addDados("listIntegrante", $integrantes);
        $this->TPageSecondary('lista');
    }

    public function informar() {

        if (!$this->isParam('id')) {
            $this->REDIRECT->goToAction("listar");
        }

        # Add JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "MetroUI/pagecontrol.js");

        # Adicionar dados a view
        $this->addDados('toolbar', TWin8Helper::displayToolBar(array('editar')));
        $this->addDados("objIntegrante", $this->logic->obterPorId($this->getParam('id'), true));

        $this->TPageSecondary('informa');
    }

    public function cadastrar() {

        # Adicionar JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "util.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "mask.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'core.js');
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        # Logic de Titulacao
        $objTitulacaoLogic = new TitulacaoLogic();
        $this->addDados("listTitulacao", TFormHelper::optionSelect($objTitulacaoLogic->listar(null, 'nome')));

        $this->TPageSecondary('cadastro');
    }

    public function inserir() {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            # Log de seguranчa
            $_POST['dataCriacao'] = time();
            $_POST['idUsuarioCriador'] = $this->SECURITY->getUsuario()->getId();

            $salvar = $this->logic->salvar($_POST);

            if ($salvar[0]) {
                TFeedbackHelper::creatFeedbackOK('Dados do Integrante cadastrado com sucesso!!!');
                $this->REDIRECT->goToAction('listar');
            } else {
                TFeedbackHelper::creatFeedbackError('Ocorreu um erro no cadastrado, os dados nуo foram salvo!!!');
                $this->REDIRECT->goToAction('cadastrar');
            }
        } else {
            $this->REDIRECT->goToAction('listar');
        }
    }

    public function editar() {

        if (!$this->isParam('id')) {
            $this->REDIRECT->goToAction("listar");
        }

        # Adicionar JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "util.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "mask.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'core.js');
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.populate.js');
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        # Adicionar dados a view
        $this->addDados('json_objeto', $this->logic->objectToJson($this->logic->obterPorId($this->getParam('id'))));

        # Adicionar titulacoes
        $objTitulacaoLogic = new TitulacaoLogic();
        $this->addDados("listTitulacao", TFormHelper::optionSelect($objTitulacaoLogic->listar(null, 'nome')));

        $this->TPageSecondary('edita');
    }

    public function atualizar() {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            # Log de seguranчa
            $_POST['idUsuarioAtualizador'] = $this->SECURITY->getUsuario()->getId();
            $_POST['dataAtualizacao'] = time();

            $salvar = $this->logic->salvar($_POST);

            if ($salvar[0]) {
                TFeedbackHelper::creatFeedbackOK('Dados do Integrante atualizado com sucesso!!!');
                $this->REDIRECT->setUrlParameter('id', $_POST['id']);
                $this->REDIRECT->goToAction('informar');
            } else {
                TFeedbackHelper::creatFeedbackError('Ocorreu um erro na atualizaчуo, os dados nуo foram salvo!!!');
                $this->REDIRECT->setUrlParameter('id', $_POST['id']);
                $this->REDIRECT->goToAction('editar');
            }
            
        } else {
            $this->REDIRECT->goToAction('listar');
        }
    }

}

?>