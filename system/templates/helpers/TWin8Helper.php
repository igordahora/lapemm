<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TWin8TemplateHelper
 *
 * @author igorsantos
 */
class TWin8Helper {
       
    public static function displayToolBar($scopo, array $icons = array(),$id=""){
        return TToolBarHelper::getInstancia()->getToolBar($scopo, $icons,$id);
    }
    
    public static function displayIniStart($image,$url = "Principal") {
        
        return "<div id='ini-start'>
                    <div id='start'>
                        <a href='".PATH_URL."index.php?{$url}'>
                            <img src='{$image}' width='120px' height='75px'>
                        </a>
                    </div>
                </div>";
    }
    
}

?>
