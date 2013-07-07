<?php

/**
 * SecurityLogic
 * @package model
 * @subpackage logic
 * 
 */
class SecurityLogic {

    /**
     * UsuarioAction::logar
     * @param objeto Usuario
     * @access publico
     * 
     */
    public function logar($POST) {

        # Logic
        $objUsuarioLogic = new UsuarioLogic();
        # Objeto Usuario
        $objUsuario = $objUsuarioLogic->obterUsuarioLogin($POST['email'], $POST['senha']);

        # Caso exista o usuário
        if (is_object($objUsuario)) {

            if ($objUsuario->getPerfil()->getStatus() == "A") {

                if (count($objUsuario->getPerfil()->getFuncionalidades()) > 0) {

                    # montar security do usuario
                    $security = $this->mountFuncionalidadesSecurity($objUsuario->getPerfil()->getId());
                    $objUsuario->setSecurity($security);
                    unset($security);

                    # Salvar Usuario
                    $usuario_save = array();
                    $usuario_save['id'] = $objUsuario->getId();
                    $usuario_save['acessos'] = $objUsuario->getAcessos() + 1;
                    $usuario_save['dataUltimoAcesso'] = time();
                    $usuario_save['tryLogon'] = '0';
                    $usuario_save['dataTryLogon'] = '0';
                    $objUsuarioLogic->salvar($usuario_save);
                    unset($usuario_save);

                    $objSecurityHelper = SecurityHelper::getInstancia();
                    $objSecurityHelper->iniciarSessao($objUsuario);
                    
                    return 0;
                    
                } else {
                    return 5;
                }
                
            } else {
                return 1;
            }
            
        } else {

            #Tentativas de Logon em um usuário existente com senha incorreta
            $objUsuario = $objUsuarioLogic->obter("email = '{$POST['email']}'");

            if (is_object($objUsuario)) {

                if ($objUsuario) {
                    $usuario_save = array();
                    $usuario_save['id'] = $objUsuario->getId();

                    if($objUsuario->getDataTryLogon() > 0){
                        
                        $time_dif = time() - $objUsuario->getDataTryLogon();
                        if($time_dif >= (5 * 60 * 60)){
                            $objUsuario->setTryLogon(0);
                        }
                        unset($time_dif);
                    }
                    
                    if ($objUsuario->getTryLogon() >= 2) {
                        $usuario_save['status'] = "D";
                    }

                    $usuario_save['tryLogon'] = $objUsuario->getTryLogon() + 1;
                    $usuario_save['dataTryLogon'] = time();

                    # Salvar dados do usuario
                    $objUsuarioLogic->salvar($usuario_save);

                    unset($usuario_save);

                    return 2;
                } else {
                    return 7;
                }
            }

            return 3;
        }
    }

    public function mountFuncionalidadesSecurity($idPerfil) {

        $objPerfilLogic = new PerfilLogic();
        $objPerfil = $objPerfilLogic->obterPorId($idPerfil, true);

        $arrayObjFuncionalidades = $objPerfil->getFuncionalidades();
        unset($objPerfilLogic);
        unset($objPerfil);

        $funcionalidade = array();

        foreach ($arrayObjFuncionalidades as $objFuncionalidade) {


            $flag = strpos($objFuncionalidade->getNome(), '_');
            # Não encontrou underline no nome
            if ($flag === false) {

                $controller = strtolower($objFuncionalidade->getNome());
                # verifica se já existe o array, caso não ixista criar
                if (!isset($funcionalidade[$controller])) {
                    $funcionalidade[$controller] = array();
                }
                unset($controller);
            } else {
                $explodeFuncionalidade = explode('_', $objFuncionalidade->getNome());
                $controller = strtolower($explodeFuncionalidade[0]);
                $action = strtolower($explodeFuncionalidade[1]);
                unset($explodeFuncionalidade);
                $funcionalidade[$controller][$action] = $objFuncionalidade->getId();
                unset($controller);
                unset($action);
            }

            unset($flag);
        }

        return $funcionalidade;
    }

}

?>