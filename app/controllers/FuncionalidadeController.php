<?php

class FuncionalidadeController extends TWin8 {

    private $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new FuncionalidadeLogic();
    }

    public function index() {
        $this->REDIRECT->goToAction('listar');
    }

    public function listar() {

        $this->addDados('toolbar', TWin8Helper::displayToolBar(array('novo')));
        $this->addDados('listFuncionalidades', $this->logic->listar(null, 'nome'));
        $this->TPageSecondary('lista');
    }

    public function informar() {

        $this->HTML->setTitle("Informaчуo da Funcionalidade");
        
        $this->addDados('toolbar', TWin8Helper::displayToolBar(array('editar')));

        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "MetroUI/pagecontrol.js");
        
        $objFuncionalidade = $this->logic->obterPorId($this->getParam('id'), true);

        $this->addDados('objFuncionalidade', $objFuncionalidade);

        $this->TPageSecondary('informa');
    }

    public function cadastrar() {

        # Adicionar o titulo da pagina
        $this->HTML->setTitle("Cadastro de Funcionalidades");

        # Adicionar JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.validate.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        $objPerfilLogic = new PerfilLogic();
        $this->addDados('listPerfil', TFormHelper::optionSelect($objPerfilLogic->listar()));
        $this->TPageSecondary('cadastro');
    }

    public function inserir() {
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $salvar = $this->logic->salvar($_POST);

            if ($salvar[0]) {
                TFeedbackHelper::creatFeedbackOK('Funcionalidade cadastrada com sucesso!!!');
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

        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.validate.js');
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.populate.js');
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . '/' . $this->_action . '.js');

        # Pegar Funcionalidade com suas devidadas colecѕes
        $objFuncionalidade = $this->logic->obterPorId($this->getParam('id'), true);

        # Pegar objeto e transformar em json e adicionar o json a view
        $this->addDados('json_objeto', $this->logic->objectToJson($this->logic->obterPorId($this->getParam('id'))));

        # Adicionar status a view
        $this->addDados('status', $objFuncionalidade->getStatus());

        # Adicionar lista de perfis da funcionalidade a view
        $this->addDados('perfis', TFormHelper::optionSelect($objFuncionalidade->getPerfis()));

        # Listar de perfis do sistema
        $objPerfilLogic = new PerfilLogic();
        $this->addDados('listPerfil', TFormHelper::optionSelect(
                        ObjectHelper::obterDiferenca(
                                $objPerfilLogic->listar(), $objFuncionalidade->getPerfis()
                        )
                )
        );

        $this->TPageSecondary('edita');
    }

    public function atualizar() {

        # verificar se campo status - caso vazil, adicionar status D
        if ($_POST['status'] == '') {
            $_POST['status'] = 'D';
        }

        $return = $this->logic->salvar($_POST, false);
        if (!$return[0]) {
            $this->REDIRECT->setUrlParameter('feedback', 0);
            $this->REDIRECT->goToAction('editar');
        }

        $this->REDIRECT->setUrlParameter('id', $_POST['id']);
        $this->REDIRECT->goToAction('informar');
    }

}

?>