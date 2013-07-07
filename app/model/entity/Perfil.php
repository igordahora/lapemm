<?php

/**
 * @Table = perfil
 */
class Perfil {

    /**
     * @Serial
     * @Colmap = ide_perfil
     */
    private $id;

    /**
     * @Colmap = nom_perfil
     */
    private $nome;

    /**
     * @Colmap = des_perfil
     */
    private $descricao;

    /**
     * @Colmap = des_status
     */
    private $status;
    
    /**
     * @Relationship (objeto=Funcionalidade,type=ManyToMany,table=perfil__funcionalidade)
     */
    private $funcionalidades;
    
    /**
     * @Relationship (objeto=Perfil,type=ManyToMany,table=perfil__responsabilidade,coluna=ide_perfil_responsavel)
     */
    private $responsabilidade;
    
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

    public function getFuncionalidades() {
        return $this->funcionalidades;
    }

    public function setFuncionalidades($funcionalidades) {
        $this->funcionalidades = $funcionalidades;
    }

    public function getResponsabilidade() {
        return $this->responsabilidade;
    }

    public function setResponsabilidade($responsabilidade) {
        $this->responsabilidade = $responsabilidade;
    }

}

?>
