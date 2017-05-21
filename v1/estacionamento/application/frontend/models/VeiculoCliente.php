<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "veiculo_cliente".
 *
 * @property integer $id_veiculo_cliente
 * @property integer $cpf_cliente
 * @property string $placa
 * @property string $modelo
 *
 * @property Cliente $cpfCliente
 */
class VeiculoCliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'veiculo_cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_veiculo_cliente', 'cpf_cliente', 'placa', 'modelo'], 'required'],
            [['id_veiculo_cliente', 'cpf_cliente'], 'integer'],
            [['placa', 'modelo'], 'string'],
            [['cpf_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cpf_cliente' => 'cpf_cliente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_veiculo_cliente' => 'Id Veiculo Cliente',
            'cpf_cliente' => 'Cpf Cliente',
            'placa' => 'Placa',
            'modelo' => 'Modelo',
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
