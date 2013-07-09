<?php

/**
 * @Table = projeto
 */
class Projeto {

    /**
     * @Serial
     * @Colmap = ide_projeto
     */
    private $id;

    /**
     * @Colmap = ide_linhadepesquisa
     * @Relationship (objeto=LinhaDePesquisa,type=OneToOne)
     * @Persistence (type=inteiro,NotNull=true)
     */
    private $linhaDePesquisa;

    /**
     * @Colmap = nom_projeto
     * @Persistence (type=texto,NotNull=true,MaxSize=120)
     */
    private $nome;

    /**
     * @Colmap = des_projeto
     * @Persistence (type=texto,NotNull=true,MaxSize=250)
     */
    private $descricao;
    
    /**
     * @Colmap = pub_projeto
     * @Persistence (type=texto,NotNull=true)
     */
    private $publicacao;
    
    /**
     * @Colmap = ide_usuario_criador
     * @Persistence (type=inteiro,NotNull=true)
     */
    private $idUsuarioCriador;

    /**
     * @Colmap = dat_criacao
     * @Persistence (type=inteiro,NotNull=true)
     */
    private $dataCriacao;

    /**
     * @Colmap = ide_usuario_atualizador
     * @Persistence (type=inteiro)
     */
    private $idUsuarioAtualizador;

    /**
     * @Colmap = dat_atualizacao
     * @Persistence (type=inteiro)
     */
    private $dataAtualizacao;

    /**
     * @Colmap = des_status
     * @Persistence (type=texto,size=1)
     */
    private $status;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLinhaDePesquisa() {
        return $this->linhaDePesquisa;
    }

    public function setLinhaDePesquisa($linhaDePesquisa) {
        $this->linhaDePesquisa = $linhaDePesquisa;
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

    public function getPublicacao() {
        return $this->publicacao;
    }

    public function setPublicacao($publicacao) {
        $this->publicacao = $publicacao;
    }

    public function getIdUsuarioCriador() {
        return $this->idUsuarioCriador;
    }

    public function setIdUsuarioCriador($idUsuarioCriador) {
        $this->idUsuarioCriador = $idUsuarioCriador;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }

    public function getIdUsuarioAtualizador() {
        return $this->idUsuarioAtualizador;
    }

    public function setIdUsuarioAtualizador($idUsuarioAtualizador) {
        $this->idUsuarioAtualizador = $idUsuarioAtualizador;
    }

    public function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    public function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}

?>
