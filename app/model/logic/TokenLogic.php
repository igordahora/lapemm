<?php

/**
 * TokenLogic
 * @package model
 * @subpackage logic
 * 
 */
class TokenLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new TokenDAO());
    }
    
}
?>