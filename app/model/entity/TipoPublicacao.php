<?php

/**
 * @Table = tipo_publicacao
 */
class TipoPublicacao {

    /**
     * @Serial
     * @Colmap = ide_tipo_publicacao
     */
    private $id;

    /**
     * @Colmap = nom_tipo_publicacao
     * @Persistence (type=texto,NotNull=true,MaxSize=120)
     */
    private $nome;

    /**
     * @Colmap = path_imagem
     * @Persistence (type=texto,NotNull=true,MaxSize=120)
     */
    private $pathImagem;

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

    public function getPathImagem() {
        return $this->pathImagem;
    }

    public function setPathImagem($pathImagem) {
        $this->pathImagem = $pathImagem;
    }

}

?>
