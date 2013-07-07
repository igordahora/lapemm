<?php

class PerfilController extends TWin8 {

    private $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new PerfilLogic();
    }

    public function index() {
        $this->REDIRECT->goToAction('listar');
    }

    public function listar() {
        $this->HTML->setTitle("Lista de Perfis");
        $this->addDados('toolbar', TWin8Helper::displayToolBar(array('novo')));
        $arrayObjPerfil = $this->logic->listar(null, "nome");

        $this->addDados('listPerfil', $arrayObjPerfil);
        $this->TPageSecondary('lista');
    }

    public function informar() {

        $this->HTML->setTitle("Informaחדo do Perfil");

        $this->addDados('toolbar', TWin8Helper::displayToolBar(array('editar')));
        
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "MetroUI/pagecontrol.js");

        $objPerfil = $this->logic->obterPorId($this->getParam('id'), true);

        $this->addDados('perfil', $objPerfil);

        $total_funcionalidades = (is_array($objPerfil->getFuncionalidades())) ? count($objPerfil->getFuncionalidades()) : 0;
        $this->addDados('total_funcionalidades', $total_funcionalidades);

        $total_responsabilidade = (is_array($objPerfil->getResponsabilidade())) ? count($objPerfil->getResponsabilidade()) : 0;
        $this->addDados('total_responsabilidade', $total_responsabilidade);

        $perfil_status = ($objPerfil->getStatus() == "A") ? "Ativo" : "Desativado";
        $this->addDados('perfil_status', $perfil_status);


        $this->TPageSecondary('informa');
    }

    public function cadastrar() {

        # Adicionar o titulo da pagina
        $this->HTML->setTitle("Cadastro de Perfis");

        # Adicionar JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'core.js');
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        $objLogicFuncionalidade = new FuncionalidadeLogic();
        $this->addDados("listFuncionalidade", TFormHelper::optionSelect($objLogicFuncionalidade->listar(null, "nome")));

        $objPerfilLogic = new PerfilLogic();
        $this->addDados("listPerfil", TFormHelper::optionSelect($objPerfilLogic->listar(null, "nome")));

        $this->TPageSecondary('cadastro');
    }

    public function inserir() {

        # verificar se campo status - caso vazil, adicionar status D
        if ($_POST['status'] == "") {
            $_POST['status'] = "D";
        }

        $return = $this->logic->salvar($_POST, false);

        if (!$return[0]) {
            // Retorno caso falso
            $this->REDIRECT->setUrlParameter("feedback", 0);
            $this->REDIRECT->goToAction('cadastrar');
        }

        $this->REDIRECT->goToAction('listar');
    }

    public function editar() {

        # Adicionar o titulo da pagina
        $this->HTML->setTitle("Editar Perfil");

        # JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.populate.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        # Perfil
        $objPerfil = $this->logic->obterPorId($this->getParam('id'), true);

        # Adicionar status a view
        $this->addDados('status', $objPerfil->getStatus());

        # Funcionalidades
        $objLogicFuncionalidade = new FuncionalidadeLogic();

        # Funcionalidade do perfil
        $this->addDados('perfil_funcionalidades', TFormHelper::optionSelect($objPerfil->getFuncionalidades()));
        # Listar de Funcionalidades do sistema
        $arrayObjFuncionalidade = $objLogicFuncionalidade->listar(null, "nome");
        $funcionalidade = ($objPerfil->getFuncionalidades() !== null) ? $objPerfil->getFuncionalidades() : array();
        $this->addDados('listFuncionalidade', TFormHelper::optionSelect(
                        ObjectHelper::obterDiferenca(
                                $arrayObjFuncionalidade, $funcionalidade
                        )
                )
        );


        # Responsabilidades
        $responsabilidade = ($objPerfil->getResponsabilidade() !== null) ? TFormHelper::optionSelect($objPerfil->getResponsabilidade()) : "";
        $this->addDados('responsabilidade', $responsabilidade);
        unset($responsabilidade);

        # Perfis responsaveis
        $objPerfilLogic = new PerfilLogic();

        # Listar de perfis do sistema
        $arrayResponsabilidade = $objPerfilLogic->listar(null, "nome");
        $arrayObjPerfis = ($objPerfil->getResponsabilidade() !== null) ? $objPerfil->getResponsabilidade() : array();
        $this->addDados('listPerfil', TFormHelper::optionSelect(
                        ObjectHelper::obterDiferenca(
                                $arrayResponsabilidade, $arrayObjPerfis
                        )
                )
        );
        unset($arrayResponsabilidade);
        unset($arrayObjPerfis);

        # Pegar objeto e transformar em json e adicionar o json a view
        $this->addDados('json_objeto', $this->logic->objectToJson($this->logic->obterPorId($this->getParam('id'))));

        # Exibir view
        $this->TPageSecondary('edita');
    }

    public function atualizar() {

        # verificar se campo status - caso vazil, adicionar status D
        if ($_POST['status'] == '') {
            $_POST['status'] = 'D';
        }

        if (!isset($_POST['responsabilidade'])) {
            $_POST['responsabilidade'] = array();
        }

        $return = $this->logic->salvar($_POST, false);
        if (!$return[0]) {
            $this->REDIRECT->setUrlParameter('feedback', 0);
            $this->REDIRECT->goToAction('cadastrar');
        }

        $this->REDIRECT->setUrlParameter('id', $_POST['id']);
        $this->REDIRECT->goToAction('informar');
    }

}

?>