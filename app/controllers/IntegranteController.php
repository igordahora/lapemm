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
        $this->addDados('toolbar', TWin8Helper::displayToolBar( array('novo') ) );
        $Integrantes = $this->logic->listar(null, 'nome', true);
        $this->addDados("listIntegrantes", $Integrantes);
        $this->TPageSecondary('lista');
    }

    public function informar() {

        if (!$this->isParam('id')) {
            $this->REDIRECT->goToAction("listar");
        }

        # Add JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "MetroUI/pagecontrol.js");

        # Adicionar dados a view
        $this->addDados('toolbar', TWin8Helper::displayToolBar( array('editar') ) );
        $this->addDados("objIntegrante", $this->logic->obterPorId($this->getParam('id'),true));

        $this->TPageSecondary('informa');
    }

    public function cadastrar() {

        # Adicionar JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "util.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'core.js');
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        $responsabilidade = implode(',', $this->SECURITY->getIntegrante()->getPerfil()->getResponsabilidade());

        # Add Perfil
        $objLogicPerfil = new PerfilLogic();

        #$perfis = $objLogicPerfil->listar("ide_perfil IN ({$responsabilidade})", "nome");
        $perfis = $objLogicPerfil->listar("ide_perfil IN ({$responsabilidade})", "nome");

        # Lista de perfis
        $this->addDados("listPerfil", TFormHelper::optionSelect((!$perfis) ? null : $perfis));
        unset($perfis);

        $this->TPageSecondary('cadastro');
    }

    public function inserir() {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $senha = SecurityHelper::gerarSenhaRandomica();

            # Criar Integrante
            $Integrante = new Integrante();
            $Integrante->setNome($_POST['nome']);
            $Integrante->setEmail($_POST['email']);
            $Integrante->setPerfil($_POST['perfil']);
            $Integrante->setSenha($senha);
            $Integrante->setDataCriacao(time());
            $Integrante->setIdIntegranteCriador($this->SECURITY->getIntegrante()->getId());
            $Integrante->setStatus("A");

            # SALVAR Integrante
            $salvar = $this->logic->salvar($Integrante, true);

            if (!$salvar[0]) {
                TFeedbackHelper::creatFeedback(0);
                $this->REDIRECT->goToAction('cadastrar');
            } else {

                # Definir mensagem de envio de email
                $assunto = '(AVISO) Dados de acesso - ' . NAME_SIS;
                $mensagem = '<h2>BEM VINDO AO ' . NAME_SIS . '.</h2>';
                $mensagem .= '- SEMPRE UTILIZE FIREFOX PARA ACESSAR O SISTEMA<br>';
                $mensagem .= '- UTILIZE O E-MAIL PARA ACESSO AO SISTEMA<br>';
                $mensagem .= '- PERFIL NO SISTEMA: <b>' . $salvar[1]->getPerfil()->getNome() . '</b><br>';
                $mensagem .= '- SENHA DE ACESSO: <b>' . $senha . '</b><br>';
                $mensagem .= "- PARA ACESSAR O SISTEMA <a href= '" . PATH_URL . "index.php'>CLIQUE AQUI</a><br>";
                $mensagem .= "- COPIE A URL E COLE NO NAVEGADOR PARA ACESSAR O SISTEMA: " . PATH_URL . "index.php'<br>";

                $emailHelper = new EmailHelper();
                $emailHelper->addDestinatario($salvar[1]->getEmail());
                $emailHelper->mail($assunto, $mensagem);
                $enviar = $emailHelper->sendMail();

                if (!$enviar) {
                    # Email não enviado
                    TFeedbackHelper::creatFeedback(1);
                    $this->REDIRECT->goToAction('listar');
                } else {
                    TFeedbackHelper::creatFeedback(1);
                    # Email enviado
                    $this->REDIRECT->goToAction('listar');
                }
            }
        } else {
            $this->REDIRECT->goToAction('listar');
        }
    }

    public function editar() {

        # Adicionar JS
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "util.validate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'core.js');
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.populate.js');
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        $responsabilidade = implode(',', $this->SECURITY->getIntegrante()->getPerfil()->getResponsabilidade());

        # Objeto colaborador
        $objIntegrante = $this->logic->obterPorId($this->getParam('id'));
        
        # Add Perfil
        $objLogicPerfil = new PerfilLogic();

        $perfis = $objLogicPerfil->listar("ide_perfil IN ({$responsabilidade})", "nome");

        # Adicionar dados a view
        $this->addDados("listPerfil", TFormHelper::optionSelect((!$perfis) ? null : $perfis));
        $this->addDados('json_objeto', $this->logic->objectToJson($objIntegrante));

        unset($perfis);

        $this->TPageSecondary('edita');
    }

    public function atualizar() {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            # Log de segurança
            $_POST['idIntegranteAtualizador'] = $this->SECURITY->getIntegrante()->getId();
            $_POST['dataAtualizacao'] = time();

            $salvar = $this->logic->salvar($_POST);

            if ($salvar[0]) {
                if (isset($_POST['alterar_senha'])) {
                    # senha alterada
                    $this->REDIRECT->setUrlParameter('feedback', 3);
                    $this->REDIRECT->goToController('Principal');
                } else {
                    $this->REDIRECT->setUrlParameter('id', $salvar[1]->getId());
                    $this->REDIRECT->goToAction('informar');
                }
            } else {
                $this->REDIRECT->goToController('Principal');
            }
        } else {
            $this->REDIRECT->goToController('Principal');
        }
    }

    public function alterarSenha() {

        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.validate.js');
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.pstrength-min.1.2.js');
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");

        $this->addDados('objIntegrante', $this->logic->obterPorId($this->SECURITY->getIntegrante()->getId()));

        $this->TPageSecondary('alteraSenha');
    }

    public function alterarAvatar() {

        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.validate.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller . "/" . $this->_action . ".js");
        $this->addDados('crop', false);
        $this->TPageSecondary('alteraAvatar');
    }

    public function carregarImagem() {

        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.Jcrop.js");
        $this->HTML->addCss(PATH_TEMPLATE_URL . "css/jquery.Jcrop.css");

        $preview = "";
        $imagem = isset($_FILES['imagem']) ? $_FILES['imagem'] : NULL;
        $tem_crop = false;
        $img = '';
        if ($imagem['tmp_name']) {
            $avatar = "fp" . time() . mt_rand(5, 15) . md5($imagem['name']) . ".jpg";
            $imagesize = getimagesize($imagem['tmp_name']);
            if ($imagesize !== false) {
                if (move_uploaded_file($imagem['tmp_name'], "public/upload/temp/" . $avatar)) {
                    $oImg = new ImagemHelper("public/upload/temp/" . $avatar);
                    if ($oImg->valida() == 'OK') {
                        $oImg->redimensiona('600', '', '');
                        $oImg->grava("public/upload/temp/" . $avatar);

                        $imagesize = getimagesize("public/upload/temp/" . $avatar);
                        $img = '<img src="' . PATH_WEBFILES_URL . 'upload/temp/' . $avatar . '" id="jcrop" ' . $imagesize[3] . ' />';
                        $tem_crop = true;
                    }
                }
            }
        }

        $this->addDados('nome', $avatar);
        $this->addDados('imagesize', $imagesize);
        $this->addDados('img', $img);
        $this->addDados('crop', $tem_crop);

        $this->TPageSecondary('alteraAvatar');
    }

    public function cortarImagem() {
        $oImg = new ImagemHelper("public/upload/temp/" . $_POST['img']);

        $objIntegrante = $this->logic->obterPorId($this->SECURITY->getIntegrante()->getId());
        $objIntegrante->setSenha(null);
        $avatarExclusao = $objIntegrante->getAvatar();
        $objIntegrante->setAvatar($_POST['img']);

        $this->logic->salvar($objIntegrante);

        if ($oImg->valida() == 'OK') {
            $oImg->posicaoCrop($_POST['x'], $_POST['y']);
            $oImg->redimensiona($_POST['w'], $_POST['h'], 'crop');
            $oImg->redimensiona('80', '', '');
            $oImg->grava("public/upload/album/" . $_POST['img']);
        }

        unlink("public/upload/album/" . $avatarExclusao);
        unlink("public/upload/temp/" . $_POST['img']);
    }

}

?>