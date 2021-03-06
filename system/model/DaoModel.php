<?php

/**
 * Class de responsavel pela regra de negocio de persistencia de dados
 *
 * @author igor
 */
abstract class DaoModel {

    /**
     * Nome da class passada para o construtor
     * @var type string
     */
    private $class;

    /**
     * Strategy a ser adotada
     * @var type 
     */
    private $strategy;

    function __construct($class) {
        $this->class = $class;
        $this->conexao();
    }

    protected function conexao($instacia = null) {

        if ($instacia === null) {
            $DAL = DefaultDAL::getInstancia();
        } else {
            $DAL = $instacia;
        }
        $type = array("mysql" => "MySql", "pgsql" => "PgSql");
        $strategy = $type[$DAL->getType()] . $DAL->getFactory() . "Strategy";

        $objReflectionORM = new ReflectionORM($this->class);
        $connectionDB = $DAL->connectDB();

        $this->strategy = new $strategy($connectionDB, $objReflectionORM);
    }

    public function obter($where, $objectCollection = null) {

        #pegar objeto pelo id
        $objeto = $this->strategy->obter($where, $objectCollection);

        # Se o retorno for false
        if (!$objeto) {
            return false;
        }

        # retorno em formato de objeto
        return $objeto;
    }

    public function obterPorId($id, $objectCollection = null, $exception = null) {

        #pegar objeto pelo id
        $objeto = $this->strategy->obterPorId($id, $objectCollection, $exception);

        # Se o retorno for false
        if (!$objeto) {
            return false;
        }

        # retorno em formato de objeto
        return $objeto;
    }

    public function listar($where = null, $orderby = null, $objectCollection = null, $exception = null, $offset = null) {

        #pegar cole��o de objetos
        $collection = $this->strategy->listar($where, $orderby, $objectCollection, $exception, $offset);

        # Se o retorno for false
        if (!$collection) {
            return false;
        }

        # retorna uma cole��o de objetos
        return $collection;
    }

    public function salvar($dados, $objectResult = null, $exception = null) {
        return $this->strategy->salvar($dados, $objectResult, $exception);
    }

    public function excluirPorId($id) {
        if (is_array($id)) {
            return $this->strategy->deleteAll($id);
        } else {
            return $this->strategy->delete($id);
        }
    }

    public function excluir($where, $dados = null) {
        return $this->strategy->excluir($where, $dados);
    }

    public function select($query) {
        return $this->strategy->select($query);
    }

    public function selectObjectAll($colunas = null, $where = null, $orderby = null, array $dados = null) {
        return $this->strategy->selectObjectAll($colunas, $where, $orderby, $dados);
    }

    public function loadObject($array, $objectCollection = null, $exception = null) {
        return $this->strategy->loadObject($array, $objectCollection, $exception);
    }

    public function objectToArray($object) {
        return $this->strategy->objectToArray($object);
    }

    public function objectToJson($object, array $arrayAdd = null) {
        return $this->strategy->objectToJson($object, $arrayAdd);
    }

    public function totalRegistro($where = null) {
         return $this->strategy->totalRegistro($where);
    }

}

?>
