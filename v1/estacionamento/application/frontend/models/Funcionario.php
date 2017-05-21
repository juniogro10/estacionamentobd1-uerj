<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "funcionario".
 *
 * @property integer $cpf_funcionario
 * @property string $senha
 * @property string $nome
 * @property integer $rg
 * @property string $sexo
 * @property string $dt_nascimento
 * @property string $telefone
 * @property integer $tipo
 *
 * @property TicketRotativo[] $ticketRotativos
 */
class Funcionario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'funcionario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['cpf_funcionario', 'senha', 'nome', 'rg', 'sexo', 'dt_nascimento', 'telefone', 'tipo'], 'required'],
            [['cpf_funcionario', 'rg', 'tipo'], 'integer'],
            [['senha', 'nome', 'telefone'], 'string'],
            [['dt_nascimento'], 'safe'],
            [['sexo'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpf_funcionario' => 'Cpf Funcionario',
            'senha' => 'Senha',
            'nome' => 'Nome',
            'rg' => 'Rg',
            'sexo' => 'Sexo',
            'dt_nascimento' => 'Dt Nascimento',
            'telefone' => 'Telefone',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketRotativos()
    {
        return $this->hasMany(TicketRotativo::className(), ['cpf_funcionario' => 'cpf_funcionario']);
    }
}
