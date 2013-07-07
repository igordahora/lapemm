<?php

/**
 * Class responsavel pelos feedback predefinidos no sistema
 * @author igorsantos
 */
class TFeedbackHelper {

    public static function isFeedback() {
        if(isset($_SESSION['feedback'])){
            return true;
        }else{
            return false;
        }
    }
    /**
     * Retorna o feedback
     * 0 - Ocorreu um problema ao tentar salvar as informa��es. <br>
     * 1 - Dados salvo na base de dados. <br>
     * 2 - Email enviado com dados para recupera��o de senha. <br>
     * 3 - Solicita��o de altera��o de senha concluida. <br>
     */
    public static function creatFeedback($value) {
        $_SESSION['feedback'] = $value;
    }

    public static function deleteFeedback() {
        unset($_SESSION['feedback']);
    }
    
    public static function getFeedback(){
        return $_SESSION['feedback'];
    }
    
    public static function mensagemOK($mensagem) {

        $msg = '';
        $msg .= '<div class="charms" id="msgPersist">';
        $msg .= '<br/>';
            $msg .= '<ul class="replies">';

                $msg .= '<li class="bg-color-green">';
                    $msg .= '<b class="sticker sticker-right sticker-color-green"></b>';

                    $msg .= '<div class="avatar">';
                        $msg .= '<img src="images/myface.jpg">';
                    $msg .= '</div>';

                    $msg .= '<div class="reply">';
                        $msg .= '<div class="date">' . date("d-m-Y", time()) . '</div>';
                        $msg .= '<div class="author">Sucesso!!!</div>';
                        $msg .= '<div class="text">' . $mensagem . '</div>';
                    $msg .= '</div>';
                    
                $msg .= '</li>';

            $msg .= '</ul>';
        $msg .= '</div>';

        return $msg;
    }

    public static function mensagemError($mensagem) {

        $msg = '';
        $msg .= '<div class="charms" id="msgPersist">';
        $msg .= '<br/>';
            $msg .= '<ul class="replies">';

                $msg .= '<li class="bg-color-red">';
                    $msg .= '<b class="sticker sticker-right sticker-color-red"></b>';

                    $msg .= '<div class="avatar">';
                        $msg .= '<img src="images/myface.jpg">';
                    $msg .= '</div>';

                    $msg .= '<div class="reply">';
                        $msg .= '<div class="date">' . date("d-m-Y", time()) . '</div>';
                        $msg .= '<div class="author">Error!!!</div>';
                        $msg .= '<div class="text">' . $mensagem . '</div>';
                    $msg .= '</div>';
                $msg .= '</li>';

            $msg .= '</ul>';
        $msg .= '</div>';

        return $msg;
    }
    
    /**
     * Retorna o feedback
     * 0 - Ocorreu um problema ao tentar salvar as informa��es. <br>
     * 1 - Dados salvo na base de dados. <br>
     * 2 - Email enviado com dados para recupera��o de senha. <br>
     * 3 - Solicita��o de altera��o de senha concluida. <br>
     * @return feedback
     */
    public static function displayFeedback(){
        
        $feedBack = '';
        if(TFeedbackHelper::isFeedback()){
            switch (TFeedbackHelper::getFeedback()) {
                
                # Problema ao salvar informa��es
                case 0:
                    $feedBack = TFeedbackHelper::mensagemError('Ocorreu um problema ao tentar salvar as informa��es.');
                    break;
                
                # Envio de email
                case 1:
                    $feedBack = TFeedbackHelper::mensagemOK('Dados salvo na base de dados.');
                    break;

                # Envio de email
                case 2:
                    $feedBack = TFeedbackHelper::mensagemOK('Email enviado com dados para recupera��o de senha.');
                    break;

                # Solicita��o de altera��o de senha
                case 3:
                    $feedBack = TFeedbackHelper::mensagemOK('Solicita��o de altera��o de senha concluida.');
                    break;

                default:
                    break;
            }
            
            TFeedbackHelper::deleteFeedBack();
        }
        
        return $feedBack;
    }    
    
}

?>
