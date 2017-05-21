<?php

namespace frontend\models;

use Yii;

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
class Cliente extends \yii\db\ActiveRecord
{
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
            [['cpf_cliente', 'nome', 'rg', 'sexo', 'email', 'dt_nascimento', 'telefone', 'ativo'], 'required'],
            [['cpf_cliente', 'nome', 'rg', 'sexo', 'ativo'], 'integer'],
            [['email', 'telefone'], 'string'],
            [['dt_nascimento'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpf_cliente' => 'Cpf Cliente',
            'nome' => 'Nome',
            'rg' => 'Rg',
            'sexo' => 'Sexo',
            'email' => 'Email',
            'dt_nascimento' => 'Dt Nascimento',
            'telefone' => 'Telefone',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeiculoClientes()
    {
        return $this->hasMany(VeiculoCliente::className(), ['cpf_cliente' => 'cpf_cliente']);
    }
}
