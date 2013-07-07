<?php

abstract class VLogicModel {

    protected $DAO;

    public function __construct(VDaoModel $objDao) {
        $this->DAO = $objDao;
    }

    public function obter($where, $objectCollection = null) {
        return $this->DAO->obter($where, $objectCollection);
    }

    public function obterPorId($id, $objectCollection = null, $exception = null) {
        return $this->DAO->obterPorId($id, $objectCollection, $exception);
    }

    public function listar($where = null, $orderby = null, $objectCollection = null, $exception = null, $offset = null) {
        return $this->DAO->listar($where, $orderby, $objectCollection, $exception, $offset);
    }

    public function select($query) {
        return $this->DAO->select($query);
    }

    public function objectToArray($object) {
        return $this->DAO->objectToArray($object);
    }

    public function objectToJson($object, array $arrayAdd = null) {
        return $this->DAO->objectToJson($object, $arrayAdd);
    }

    public function selectObjectAll($colunas = null, $where = null, $orderby = null, array $dados = null) {
        return $this->DAO->selectObjectAll($colunas, $where, $orderby, $dados);
    }

    public function totalRegistro($where = null) {
        return $this->DAO->totalRegistro($where);
    }

}

?>
