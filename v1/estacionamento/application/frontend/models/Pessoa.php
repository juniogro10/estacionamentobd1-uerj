<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "pessoa".
 *
 * @property integer $cpf
 * @property string $nome
 * @property string $sexo
 * @property string $data_nascimento
 * @property string $rg
 * @property string $telefone
 * @property integer $tipo
 * @property integer $ativo
 *
 * @property Cliente $cliente
 * @property Funcionario $funcionario
 */
class Pessoa extends Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpf', 'nome', 'sexo', 'data_nascimento', 'rg', 'telefone', 'tipo', 'ativo'], 'required'],
            [['cpf', 'tipo', 'ativo'], 'integer'],
            [['nome', 'telefone'], 'string'],
            [['data_nascimento'], 'safe'],
            [['sexo'], 'string', 'max' => 1],
            [['rg'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpf' => 'Cpf',
            'nome' => 'Nome',
            'sexo' => 'Sexo',
            'data_nascimento' => 'Data Nascimento',
            'rg' => 'Rg',
            'telefone' => 'Telefone',
            'tipo' => 'Tipo',
            'ativo' => 'Ativo',
        ];
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getCliente()
//    {
//        return $this->hasOne(Cliente::className(), ['cpf_cliente' => 'cpf']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getFuncionario()
//    {
//        return $this->hasOne(Funcionario::className(), ['cpf_funcionario' => 'cpf']);
//    }
}
