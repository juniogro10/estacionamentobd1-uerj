<?php

namespace frontend\models;

use common\components\Database;
use Exception;
use Yii;
use yii\base\Model;


class ClienteInfo extends Model
{
    public $cpf_cliente;
    public $cpf;
    public $cnh;
    public $email;
    public $nome;
    public $sexo;
    public $data_nascimento;
    public $rg;
    public $telefone;
    public $tipo;
    public $ativo;

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return int
     */
    public function getCpfCliente()
    {
        return $this->cpf_cliente;
    }

    /**
     * @param int $cpf_cliente
     */
    public function setCpfCliente($cpf_cliente)
    {
        $this->cpf_cliente = $cpf_cliente;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getCnh()
    {
        return $this->cnh;
    }

    /**
     * @param string $cnh
     */
    public function setCnh($cnh)
    {
        $this->cnh = $cnh;
    }


    /**
     * @return PagamentoCliente[]
     */
    public function getPagamentoClientes()
    {
        return $this->pagamentoClientes;
    }

    /**
     * @param PagamentoCliente[] $pagamentoClientes
     */
    public function setPagamentoClientes($pagamentoClientes)
    {
        $this->pagamentoClientes = $pagamentoClientes;
    }

    /**
     * @return VeiculoCliente[]
     */
    public function getVeiculoClientes()
    {
        return $this->veiculoClientes;
    }

    /**
     * @param VeiculoCliente[] $veiculoClientes
     */
    public function setVeiculoClientes($veiculoClientes)
    {
        $this->veiculoClientes = $veiculoClientes;
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
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    /**
     * @param mixed $data_nascimento
     */
    public function setDataNascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }

    /**
     * @return mixed
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param mixed $rg
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }


}