<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pagamento_cliente".
 *
 * @property integer $id_pagamento
 * @property integer $cpf_cliente
 * @property double $valor_pago
 * @property string $data_hora_pagamento
 *
 * @property Cliente $cpfCliente
 */
class PagamentoCliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagamento_cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpf_cliente', 'valor_pago'], 'required'],
            [['cpf_cliente'], 'integer'],
            [['valor_pago'], 'number'],
            [['data_hora_pagamento'], 'safe'],
            [['cpf_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cpf_cliente' => 'cpf_cliente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pagamento' => 'Id Pagamento',
            'cpf_cliente' => 'Cpf Cliente',
            'valor_pago' => 'Valor Pago',
            'data_hora_pagamento' => 'Data Hora Pagamento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpfCliente()
    {
        return $this->hasOne(Cliente::className(), ['cpf_cliente' => 'cpf_cliente']);
    }
}
