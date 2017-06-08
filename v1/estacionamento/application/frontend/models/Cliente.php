<?php

namespace frontend\models;

use common\components\Database;
use Exception;
use Yii;
use yii\base\Model;
use yiibr\brvalidator\CpfValidator;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $cpf_cliente
 * @property integer $nome
 * @property integer $rg
 * @property integer $sexo
 * @property string $email
 * @property string $dt_nascimento
 * @property string $telefone
 * @property integer $ativo
 *
 * @property VeiculoCliente[] $veiculoClientes
 */
class Cliente extends Model
{
    public $nome;
    public $rg;
    public $cpf_cliente;
    public $sexo;
    public $dt_nascimento;
    public $telefone;
    public $ativo;
    public $email;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpf_cliente', 'nome', 'rg', 'telefone','dt_nascimento','sexo','email'], 'required'],
            [[ 'rg', 'sexo', 'ativo'], 'integer'],

            [['cpf_cliente','email', 'telefone', 'nome'], 'string'],
            [['cpf_cliente'], CpfValidator::className()],
            [['dt_nascimento'], 'safe'],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpf_cliente' => 'Cpf do Cliente',
            'nome' => 'Nome do Cliente',
            'rg' => 'RG do Cliente',
            'sexo' => 'Sexo do Cliente',
            'email' => 'Email do cliente',
            'dt_nascimento' => 'Data de Nascimento do CLiente',
            'telefone' => 'Telefone do Cliente',
            'ativo' => 'Ativo',
        ];
    }


    public function cadastrar()
    {
//        var_dump($this->getSexo());
//        exit;

        try {
            $query = "INSERT INTO " . Cliente::tableName() . " (cpf_cliente,nome,rg,sexo,email,dt_nascimento,telefone,ativo)
             VALUES ('" . $this->getCpfCliente() . "','" . $this->getNome() . "','" . $this->getRg() . "','" . $this->getSexo() . "','" . $this->getEmail() . "','" . $this->getDtNascimento_sql() ."','"  . $this->replace($this->getTelefone(),'_') . "','1')";

            var_dump($query);
            exit;

            $query_result = Database::query_execute($query);


            if ($query_result) {
                Yii::$app->session->setFlash('success', 'Entrada Registrada com sucesso');
                return;
            }
            Yii::$app->session->setFlash('warning', 'Tente Novamente');
            throw new \Exception('query_result retornando errado');
        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }


    private function replace($palavra,$de,$por = '')
    {

        return str_replace($de,$por,$palavra);
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
     * @return int
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param int $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return int
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param int $rg
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    /**
     * @return int
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param int $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
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
    public function getDtNascimento()
    {
        return $this->dt_nascimento;
    }

    /**
     * @param string $dt_nascimento
     */
    public function setDtNascimento($dt_nascimento)
    {
        $this->dt_nascimento = $dt_nascimento;
    }

    public function getDtNascimento_sql()
    {
        return self::format_date_sql($this->getDtNascimento());
    }

    public function getDtNascimento_brl()
    {
        return self::format_date_brl($this->getDtNascimento());
    }

    /**
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * @return int
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param int $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }


    private function format_date_sql($date)
    {
        $timestamp = strtotime($date);
        $mydate = date('Y-m-d', $timestamp);
        return $mydate;
    }
    private function format_date_brl($date)
    {
        $timestamp = strtotime($date);
        $mydate = date('d-m-Y', $timestamp);
        return $mydate;
    }


//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getVeiculoClientes()
//    {
//        return $this->hasMany(VeiculoCliente::className(), ['cpf_cliente' => 'cpf_cliente']);
//    }
}
