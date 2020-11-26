<?php
/**
 * Created by PhpStorm.
 * User: devwarlt
 * Date: 26/11/2020
 * Time: 16:56
 */

namespace model;

final class UsuarioModel
{
    private $id, $nome, $usuario, $cpf, $celular, $senha, $confir_senha, $email, $data_nascimento, $estado, $cidade, $numerodocartao, $codigocartao, $validadecartao;

    public function __construct(int $id, string $nome, string $usuario, string $cpf, string $celular, string $senha, string $confir_senha, string $email, string $data_nascimento, string $estado, string $cidade, string $numerodocartao, int $codigocartao, string $validadecartao)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->usuario = $usuario;
        $this->cpf = $cpf;
        $this->celular = $celular;
        $this->senha = $senha;
        $this->confir_senha = $confir_senha;
        $this->email = $email;
        $this->data_nascimento = $data_nascimento;
        $this->estado = $estado;
        $this->cidade = $cidade;
        $this->numerodocartao = $numerodocartao;
        $this->codigocartao = $codigocartao;
        $this->validadecartao = $validadecartao;
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
     * @return UsuarioModel
     */
    public function setId(int $id): UsuarioModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return UsuarioModel
     */
    public function setNome(string $nome): UsuarioModel
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsuario(): string
    {
        return $this->usuario;
    }

    /**
     * @param string $usuario
     * @return UsuarioModel
     */
    public function setUsuario(string $usuario): UsuarioModel
    {
        $this->usuario = $usuario;
        return $this;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * @return UsuarioModel
     */
    public function setCpf(string $cpf): UsuarioModel
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return string
     */
    public function getCelular(): string
    {
        return $this->celular;
    }

    /**
     * @param string $celular
     * @return UsuarioModel
     */
    public function setCelular(string $celular): UsuarioModel
    {
        $this->celular = $celular;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     * @return UsuarioModel
     */
    public function setSenha(string $senha): UsuarioModel
    {
        $this->senha = $senha;
        return $this;
    }

    /**
     * @return string
     */
    public function getConfirSenha(): string
    {
        return $this->confir_senha;
    }

    /**
     * @param string $confir_senha
     * @return UsuarioModel
     */
    public function setConfirSenha(string $confir_senha): UsuarioModel
    {
        $this->confir_senha = $confir_senha;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UsuarioModel
     */
    public function setEmail(string $email): UsuarioModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataNascimento(): string
    {
        return $this->data_nascimento;
    }

    /**
     * @param string $data_nascimento
     * @return UsuarioModel
     */
    public function setDataNascimento(string $data_nascimento): UsuarioModel
    {
        $this->data_nascimento = $data_nascimento;
        return $this;
    }

    /**
     * @return string
     */
    public function getEstado(): string
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     * @return UsuarioModel
     */
    public function setEstado(string $estado): UsuarioModel
    {
        $this->estado = $estado;
        return $this;
    }

    /**
     * @return string
     */
    public function getCidade(): string
    {
        return $this->cidade;
    }

    /**
     * @param string $cidade
     * @return UsuarioModel
     */
    public function setCidade(string $cidade): UsuarioModel
    {
        $this->cidade = $cidade;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumerodocartao(): string
    {
        return $this->numerodocartao;
    }

    /**
     * @param string $numerodocartao
     * @return UsuarioModel
     */
    public function setNumerodocartao(string $numerodocartao): UsuarioModel
    {
        $this->numerodocartao = $numerodocartao;
        return $this;
    }

    /**
     * @return int
     */
    public function getCodigocartao(): int
    {
        return $this->codigocartao;
    }

    /**
     * @param int $codigocartao
     * @return UsuarioModel
     */
    public function setCodigocartao(int $codigocartao): UsuarioModel
    {
        $this->codigocartao = $codigocartao;
        return $this;
    }

    /**
     * @return string
     */
    public function getValidadecartao(): string
    {
        return $this->validadecartao;
    }

    /**
     * @param string $validadecartao
     * @return UsuarioModel
     */
    public function setValidadecartao(string $validadecartao): UsuarioModel
    {
        $this->validadecartao = $validadecartao;
        return $this;
    }
}