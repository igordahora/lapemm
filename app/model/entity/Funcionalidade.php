<?php

/**
 * @Table = funcionalidade
 */
class Funcionalidade {

    /**
     * @Serial
     * @Colmap = ide_funcionalidade
     */
    private $id;

    /**
     * @Colmap = nom_funcionalidade
     */
    private $nome;

    /**
     * @Colmap = des_funcionalidade
     */
    private $descricao;

    /**
     * @Colmap = des_status
     */
    private $status;
    
    /**
     * @Relationship (objeto=Perfil,type=ManyToMany,table=perfil_has_funcionalidade)
     */
    private $perfis;

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

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getPerfis() {
        return $this->perfis;
    }

    public function setPerfis($perfis) {
        $this->perfis = $perfis;
    }

}

?>