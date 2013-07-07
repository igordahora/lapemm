<?php

/**
 * Class Responsavel pelas requisiçoes de AJAX
 * @author igor
 */
class AjaxController extends TWin8 {

    public function index() {
        $this->REDIRECT->goToController('Principal');
    }

    /**
     * AJAX
     * Se usuario não existir na base de dados
     * @return bollean
     */
    public function emailUniqueUsuario() {
        $usuarioLogic = new UsuarioLogic();
        $usuario = $usuarioLogic->obter("email = '{$_POST['email']}'");
        echo ( is_object($usuario) ) ? 'false' : 'true';
    }

    /**
     * AJAX
     * Se usuario não existir na base de dados e for diferente do usuario corrente
     * @return bollean
     */
    public function emailUniqueUsuarioEditar() {
        $usuarioLogic = new UsuarioLogic();
        $objUsuarioReal = $usuarioLogic->obterPorId($_POST['idUsurio']);
        $usuario = $usuarioLogic->obter("email = '{$_POST['email']}'");
        if($objUsuarioReal->getEmail() != $_POST['email']){
            echo (is_object($usuario)) ? 'false' : 'true';
        }else{
            echo 'true';
        }
    }

    //Ajax
    public function isPassword() {
        $objUsuarioLogic = new UsuarioLogic();
        $objUsuario = $objUsuarioLogic->obterPorId($this->SECURITY->getUsuario()->getId());
        $senha_md5 = md5($this->getParam('senha_atual'));

        if ($objUsuario->getSenha() === $senha_md5) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

}

?>
