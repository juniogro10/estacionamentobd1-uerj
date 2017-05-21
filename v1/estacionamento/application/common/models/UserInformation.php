<?php

namespace common\models;

use app\models\PagamentoTipo;
use DateTime;
use Yii;

/**
 * This is the model class for table "user_information".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $cpf
 * @property string $nome
 * @property string $sobrenome
 * @property string $telefone
 * @property integer $id_pagamento_tipo
 * @property string $cartao_truncado
 * @property string $token_cielo
 * @property string $bandeira
 * @property string $licenca_limite
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PagamentoTipo $idPagamentoTipo
 * @property User $idUser
 */
class UserInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'cpf', 'nome', 'sobrenome', 'telefone'], 'required'],
            [['id_user', 'cpf', 'id_pagamento_tipo'], 'integer'],
            [['nome', 'sobrenome', 'telefone', 'cartao_truncado', 'token_cielo', 'bandeira'], 'string'],
            ['licenca_limite', 'default', 'value' => date('Y-m-d G:i:s', strtotime("+30 days"))],
            [['created_at', 'updated_at'], 'safe'],
            [['cpf'], 'unique'],
            [['id_pagamento_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => PagamentoTipo::className(), 'targetAttribute' => ['id_pagamento_tipo' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'cpf' => 'Cpf',
            'nome' => 'Nome',
            'sobrenome' => 'Sobrenome',
            'telefone' => 'Telefone',
            'id_pagamento_tipo' => 'Id Pagamento Tipo',
            'cartao_truncado' => 'Cartao Truncado',
            'token_cielo' => 'Token Cielo',
            'bandeira' => 'Bandeira',
            'licenca_limite' => 'Licenca Limite',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getIdPagamentoTipo()
//    {
//        return $this->hasOne(PagamentoTipo::className(), ['id' => 'id_pagamento_tipo']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getIsValid()
    {
        $today = date("Y-m-d G:i:s");

        $return = [];
        $return['ativo'] = $today <= $this->licenca_limite;

        if ($return['ativo']) {
            $datetime_hoje = new DateTime($today);
            $datetime_expiracao = new DateTime($this->licenca_limite);
            $dDiff = $datetime_hoje->diff($datetime_expiracao);

            $return['dias'] = $dDiff->days;
        } else {
            return false;
        }
        return $return;
    }

    public function getDaysLicense()
    {
        $today = date("Y-m-d G:i:s");

        $datetime_hoje = new DateTime($today);
        $datetime_create = new DateTime($this->licenca_limite);
        $dDiff = $datetime_create->diff($datetime_hoje);

        return $dDiff->days;
    }

    public function getIsTrial()
    {
        $today = date("Y-m-d G:i:s");

        $datetime_hoje = new DateTime($today);
        $datetime_create = new DateTime($this->created_at);
        $dDiff = $datetime_create->diff($datetime_hoje);
        if ($dDiff->days <= 30) {
            return true;
        }
        return false;
    }

    public function setTimeLicense($day)
    {
        $date = new DateTime($this->licenca_limite);

        $date->modify($day . ' days');
        $this->licenca_limite = $date->format('Y-m-d H:i:s');

        return $this->save();
    }
}
