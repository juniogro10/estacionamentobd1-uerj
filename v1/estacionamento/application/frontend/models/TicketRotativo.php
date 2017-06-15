<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ticket_rotativo".
 *
 * @property integer $id_ticket_rotativo
 * @property integer $cpf_funcionario
 * @property string $placa
 * @property string $data_hora_entrada
 * @property string $data_hora_saida
 * @property double $valor_pago
 *
 * @property Funcionario $cpfFuncionario
 */
class TicketRotativo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_rotativo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpf_funcionario', 'placa', 'valor_pago'], 'required'],
            [['cpf_funcionario'], 'integer'],
            [['placa'], 'string'],
            [['data_hora_entrada', 'data_hora_saida'], 'safe'],
            [['valor_pago'], 'number'],
            [['cpf_funcionario'], 'exist', 'skipOnError' => true, 'targetClass' => Funcionario::className(), 'targetAttribute' => ['cpf_funcionario' => 'cpf_funcionario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ticket_rotativo' => 'Id Ticket Rotativo',
            'cpf_funcionario' => 'Cpf Funcionario',
            'placa' => 'Placa',
            'data_hora_entrada' => 'Data Hora Entrada',
            'data_hora_saida' => 'Data Hora Saida',
            'valor_pago' => 'Valor Pago',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpfFuncionario()
    {
        return $this->hasOne(Funcionario::className(), ['cpf_funcionario' => 'cpf_funcionario']);
    }
}
