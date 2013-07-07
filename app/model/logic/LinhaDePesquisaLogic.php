<?php

class LinhaDePesquisaLogic extends LogicModel{
    public function __construct() {
        parent::__construct(new LinhaDePesquisaDAO());
    }
}

?>
