<?php

/**
 * @Table = linhadepesquisa
 */
class LinhaDePesquisa {

    /**
     * @Serial
     * @Colmap = ide_linhadepesquisa
     */
    private $id;

    /**
     * @Colmap = nom_linha
     * @Persistence (type=texto,NotNull=true)
     */
    private $nome;

    /**
     * @Colmap = des_linha
     * @Persistence (type=texto)
     */
    private $descricao;

    /**
     * @Colmap = ide_usuario_criador
     * @Persistence (type=texto,NotNull=true)
     */
    private $idUsuarioCriador;

    /**
     * @Colmap = dat_criacao
     * @Persistence (type=inteiro,NotNull=true)
     */
    private $dataCriacao;

    /**
     * @Colmap = ide_usuario_atualizador
     * @Persistence (type=texto)
     */
    private $idUsuarioAtualizador;

    /**
     * @Colmap = dat_atualizacao
     * @Persistence (type=inteiro)
     */
    private $dataAtualizacao;

    /**
     * @Colmap = des_status
     * @Persistence (type=texto,NotNull=true,size=1)
     */
    private $status;

    
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
