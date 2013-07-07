<?php

/**
 * PerfilLogic
 * @package model
 * @subpackage logic
 * 
 */
class PerfilLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new PerfilDAO());
    }
 
    public function listaDePerfisDoSistema($and = null, $orderby = null, $objectCollection= null){
        $and = ($and !== null) ? " AND $and":"";
        $where = "ide_sistema = " . OID_SIS . $and;
        return $this->listar($where, $orderby, $objectCollection);
    }
}
?>