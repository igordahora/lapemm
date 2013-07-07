<?php

/**
 * @Table = titulacao
 */
class Titulacao {

    /**
     * @Serial
     * @Colmap = ide_titulacao
     */
    private $id;

    /**
     * @Colmap = nom_titulacao
     * @Persistence (type=texto,NotNull=true,MaxSize=80)
     */
    private $nome;

    /**
     * @Colmap = des_titulacao
     * @Persistence (type=texto,MaxSize=250)
     */
    private $descricao;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}

?>
