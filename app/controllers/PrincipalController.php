<?php

/**
 * Description of PrincipalController
 * @author igor
 */
class PrincipalController extends TWin8 {
    
    public function index() {
        
        $this->HTML->addJavaScript(PATH_JS_URL . $this->_controller. "/" . $this->_action . ".js");
        
        $arrayNome = FormatHelper::quebrarNome($this->SECURITY->getUsuario()->getNome());
        $this->addDados('nome', current($arrayNome));
        $this->addDados('sobrenome', end($arrayNome));
        unset($arrayNome);
        
        #id colaborador
        $this->addDados('idUsuario', $this->SECURITY->getUsuario()->getId());
        
        $this->addDados('CursoSugerido', $this->SECURITY->isAllowed('cursosugerido'));
        $this->addDados('AreaDeConhecimento', $this->SECURITY->isAllowed('areadeconhecimento'));
        $this->addDados('usuario', $this->SECURITY->isAllowed('usuario'));
        $this->addDados('perfil', $this->SECURITY->isAllowed('perfil'));
        $this->addDados('funcionalidade', $this->SECURITY->isAllowed('funcionalidade'));
        
        $objUsuarioLogic = new UsuarioLogic();
        $objUsuario = $objUsuarioLogic->obterPorId($this->SECURITY->getUsuario()->getId());
        unset($objUsuarioLogic);
        
        $this->addDados('avatar', ($objUsuario->getAvatar() !== null)? $objUsuario->getAvatar() : 'default.jpg');
        unset($objUsuario);
        
        $this->TMetro("index");
    }
    
}

?>