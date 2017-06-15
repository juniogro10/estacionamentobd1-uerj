<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $cpf_cliente
 * @property string $email
 * @property string $cnh
 *
 * @property Pessoa $cpfCliente
 * @property PagamentoCliente[] $pagamentoClientes
 * @property VeiculoCliente[] $veiculoClientes
 */
class Cliente extends Model
{

    const ATIVO = 1;
    const DESATIVADO = 0;
    public $cpf_cliente;
    public $cnh;
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
            [['cpf_cliente', 'email', 'cnh'], 'required'],
            [['cpf_cliente'], 'integer'],
            [['email'], 'string'],
            [['cnh'], 'string', 'max' => 15],
//            [['cpf_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['cpf_cliente' => 'cpf']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpf_cliente' => 'Cpf Cliente',
            'email' => 'Email',
            'cnh' => 'Cnh',
        ];
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

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getCpfCliente()
//    {
//        return $this->hasOne(Pessoa::className(), ['cpf' => 'cpf_cliente']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getPagamentoClientes()
//    {
//        return $this->hasMany(PagamentoCliente::className(), ['cpf_cliente' => 'cpf_cliente']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getVeiculoClientes()
//    {
//        return $this->hasMany(VeiculoCliente::className(), ['cpf_cliente' => 'cpf_cliente']);
//    }
}
