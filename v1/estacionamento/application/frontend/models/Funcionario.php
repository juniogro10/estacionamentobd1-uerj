<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "funcionario".
 *
 * @property integer $cpf_funcionario
 * @property string $senha
 * @property integer $tipo
 *
 * @property Pessoa $cpfFuncionario
 * @property TicketRotativo[] $ticketRotativos
 */
class Funcionario extends Model
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
            [['cpf_funcionario', 'senha', 'tipo'], 'required'],
            [['cpf_funcionario', 'tipo'], 'integer'],
            [['senha'], 'string'],
//            [['cpf_funcionario'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['cpf_funcionario' => 'cpf']],
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
            'tipo' => 'Tipo',
        ];
    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getCpfFuncionario()
//    {
//        return $this->hasOne(Pessoa::className(), ['cpf' => 'cpf_funcionario']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getTicketRotativos()
//    {
//        return $this->hasMany(TicketRotativo::className(), ['cpf_funcionario' => 'cpf_funcionario']);
//    }
}
