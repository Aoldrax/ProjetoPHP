<?php


namespace model;


final class FilmeModel
{
    private $id, $nome, $duracao, $nome_diretor, $data_lançamento, $usuario_id;

    public function __construct(int $id, string $nome, string $duracao, string $nome_diretor, string $data_lançamento, int $usuario_id)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->duracao = $duracao;
        $this->nome_diretor = $nome_diretor;
        $this->data_lançamento = $data_lançamento;
        $this->usuario_id = $usuario_id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDuracao()
    {
        return $this->duracao;
    }

    /**
     * @param mixed $duracao
     */
    public function setDuracao($duracao): void
    {
        $this->duracao = $duracao;
    }

    /**
     * @return mixed
     */
    public function getNomeDiretor()
    {
        return $this->nome_diretor;
    }

    /**
     * @param mixed $nome_diretor
     */
    public function setNomeDiretor($nome_diretor): void
    {
        $this->nome_diretor = $nome_diretor;
    }

    /**
     * @return mixed
     */
    public function getDataLançamento()
    {
        return $this->data_lançamento;
    }

    /**
     * @param mixed $data_lançamento
     */
    public function setDataLançamento($data_lançamento): void
    {
        $this->data_lançamento = $data_lançamento;
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * @param mixed $usuario_id
     */
    public function setUsuarioId($usuario_id): void
    {
        $this->usuario_id = $usuario_id;
    }

}