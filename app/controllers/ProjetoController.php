<?php

class ProjetoController extends TWin8 {

    private $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new ProjetoLogic();
    }

    public function index() {
        $this->REDIRECT->goToAction('listar');
    }

    public function listar() {
        $this->addDados('toolbar', TWin8Helper::displayToolBar(array('novo')));
        $this->addDados("listProjeto", $this->logic->listar(null, 'nome'));
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
        $this->addDados("objProjeto", $this->logic->obterPorId($this->getParam('id'),true));

        $this->TPageSecondary('informa');
    }

    public function cadastrar() {

        # Adicionar JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.validate.js");
        $this->HTML->addJavaScript(PATH_PLUGIN_URL . 'NicEdit/nicEdit.js');
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        # Lista de linhas de pesquisa
        $objLinhaDePesquisaLogic = new LinhaDePesquisaLogic();
        $listObjLinhaDePesquisa = $objLinhaDePesquisaLogic->listar("des_status = 'A'");
        $this->addDados("listLinhaDePesquisa", TFormHelper::optionSelect((!$listObjLinhaDePesquisa) ? null : $listObjLinhaDePesquisa));
        
        # Limpar Memoria
        unset($objLinhaDePesquisaLogic);
        unset($listObjLinhaDePesquisa);
        
        # Exibir view
        $this->TPageSecondary('cadastro');
    }

    public function inserir() {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            # Log de seguranчa
            $_POST['dataCriacao'] = time();
            $_POST['idUsuarioCriador'] = $this->SECURITY->getUsuario()->getId();

            $salvar = $this->logic->salvar($_POST);

            if ($salvar[0]) {
                TFeedbackHelper::creatFeedbackOK('Projeto cadastrado com sucesso!!!');
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
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.populate.js');
        $this->HTML->addJavaScript(PATH_PLUGIN_URL . 'NicEdit/nicEdit.js');
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        # Lista de linhas de pesquisa
        $objLinhaDePesquisaLogic = new LinhaDePesquisaLogic();
        $listObjLinhaDePesquisa = $objLinhaDePesquisaLogic->listar("des_status = 'A'");
        $this->addDados("listLinhaDePesquisa", TFormHelper::optionSelect((!$listObjLinhaDePesquisa) ? null : $listObjLinhaDePesquisa));
        
        # Limpar Memoria
        unset($objLinhaDePesquisaLogic);
        unset($listObjLinhaDePesquisa);
        
        # Adicionar dados a view
        $this->addDados('json_objeto', $this->logic->objectToJson($this->logic->obterPorId($this->getParam('id'))));

        $this->TPageSecondary('edita');
    }

    public function atualizar() {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            # Log de seguranчa
            $_POST['idUsuarioAtualizador'] = $this->SECURITY->getUsuario()->getId();
            $_POST['dataAtualizacao'] = time();

            $salvar = $this->logic->salvar($_POST);

            if ($salvar[0]) {
                TFeedbackHelper::creatFeedbackOK('Projeto atualizado com sucesso!!!');
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