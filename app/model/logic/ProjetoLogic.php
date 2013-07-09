<?php

class ProjetoLogic extends LogicModel{
    public function __construct() {
        parent::__construct(new ProjetoDAO());
    }
}

?>
