<?php

/**
 * @Table = publicacao
 */
class Publicacao {

    /**
     * @Serial
     * @Colmap = ide_publicacao
     */
    private $id;

    /**
     * @Colmap = ide_tipo_publicacao
     * @Relationship (objeto=TipoPublicacao,type=OneToOne)
     * @Persistence (type=inteiro,NotNull=true)
     */
    private $tipo;

    /**
     * @Colmap = des_publicacao
     * @Persistence (type=texto)
     */
    private $descricao;

    /**
     * @Colmap = nom_titulo
     * @Persistence (type=texto,NotNull=true,MaxSize=120)
     */
    private $titulo;

    /**
     * @Colmap = dat_publicacao
     * Mask = data
     * @Persistence (type=data,NotNull=true,size=8)
     */
    private $dataPublicacao;

    /**
     * @Colmap = nom_autor
     * @Persistence (type=texto,NotNull=true,MaxSize=120)
     */
    private $autor;

    /**
     * @Colmap = path_imagem
     * @Persistence (type=texto,MaxSize=120)
     */
    private $pathImagem;

    /**
     * @Colmap = path_arquivo
     * @Persistence (type=texto,MaxSize=120)
     */
    private $pathArquivo;

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

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getDataPublicacao() {
        return $this->dataPublicacao;
    }

    public function setDataPublicacao($dataPublicacao) {
        $this->dataPublicacao = $dataPublicacao;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getPathImagem() {
        return $this->pathImagem;
    }

    public function setPathImagem($pathImagem) {
        $this->pathImagem = $pathImagem;
    }

    public function getPathArquivo() {
        return $this->pathArquivo;
    }

    public function setPathArquivo($pathArquivo) {
        $this->pathArquivo = $pathArquivo;
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