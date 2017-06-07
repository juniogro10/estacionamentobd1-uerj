<?php

namespace frontend\models;

use common\components\Database;
use DateTime;
use Exception;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

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
//class TicketRotativo extends \yii\db\ActiveRecord
class TicketRotativo extends Model
{

    public $placa;
    public $data_hora_saida;
    public $valor_pago;
    public $cpf_funcionario;
    public $id_ticket_rotativo;
    public $data_hora_entrada;
//    public $cpf_funcionario;

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
            [['placa', 'cpf_funcionario'], 'required'],
            [['cpf_funcionario'], 'integer'],
            [['placa'], 'required'],
            [['placa', 'data_hora_saida'], 'string'],
            [['data_hora_entrada'], 'safe'],
            [['valor_pago'], 'number'],

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


    public static function findplaca($placa)
    {
        try {
            $query = "SELECT * FROM " . TicketRotativo::tableName() . " WHERE placa ='" . $placa . "' ORDER BY data_hora_entrada DESC LIMIT 1;";

            $query_result = Database::query_all($query);

            if ($query_result) {

                $model = new TicketRotativo();
                try {

//                    var_dump($query_result[0]);
//                    var_dump(['TicketRotativo' => $query_result[0]]);
//                    var_dump(['TicketRotativo' => [$query_result[0]]]);
//                    exit;

//                    $model->attributes = $query_result[0];
//                    $model->load(['TicketRotativo' => [$query_result[0]]]);

                    $model->id_ticket_rotativo = $query_result[0]['id_ticket_rotativo'];
                    $model->cpf_funcionario = $query_result[0]['cpf_funcionario'];
                    $model->placa = $query_result[0]['placa'];
                    $model->data_hora_entrada = $query_result[0]['data_hora_entrada'];
                    $model->data_hora_saida = $query_result[0]['data_hora_saida'];
                    $model->valor_pago = $query_result[0]['valor_pago'];

                    return $model;

                } catch (\Exception $e) {

                    var_dump($query_result[0]);
                    var_dump("deu ruim");
                    var_dump($e->getMessage());
                    exit;
                }

                return $model;
            } else {
                return false;
            }

        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }


    public function atualizar()
    {
//        return true;

        try {
            $query = "UPDATE " . TicketRotativo::tableName() . " SET data_hora_saida ='". $this->data_hora_saida . "' , valor_pago = '" .$this->valor_pago ."'   WHERE id_ticket_rotativo ='". $this->id_ticket_rotativo. "'";
//            var_dump($query);
//            exit;
            $query_result = Database::query_execute($query);

            if ($query_result) {
                Yii::$app->session->setFlash('success', 'Pagamento Salvo');
                return true;
            }
            Yii::$app->session->setFlash('warning', 'Tente Novamente');
            throw new \Exception('query_result retornando errado');
        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }

    public function entrada()
    {
        try {
            $query = "INSERT INTO " . TicketRotativo::tableName() . " (cpf_funcionario,placa) VALUES ('" . \Yii::$app->user->getId() . "',' " . $this->placa . "')";
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

    public function saida_valor()
    {
        $date_saida = new DateTime($this->getDataHoraSaida());
        $date_entrada = new DateTime($this->getDataHoraEntrada());

        $diff = $date_saida->diff($date_entrada);

        $hours = $diff->h;

        if($diff->i > 0)
        {
            $hours++;
        }

        $hours = $hours + ($diff->days * 24);
        $valor_fracao = 10;

        return $hours * $valor_fracao;
    }

    public function mensal()
    {
        return false;
    }
    /**
     * @return string
     */
    public function getDataHoraEntrada()
    {
        return $this->data_hora_entrada;
    }

    /**
     * @param string $data_hora_entrada
     */
    public function setDataHoraEntrada($data_hora_entrada)
    {
        $this->data_hora_entrada = $data_hora_entrada;
    }

    /**
     * @return string
     */
    public function getDataHoraSaida()
    {
        return $this->data_hora_saida;
    }

    /**
     * @param string $data_hora_saida
     */
    public function setDataHoraSaida()
    {
        $this->data_hora_saida = date("Y-m-d H:i:s");
    }

    /**
     * @return string
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * @param string $placa
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }

    /**
     * @return float
     */
    public function getValorPago()
    {
        return $this->valor_pago;
    }

    /**
     * @param float $valor_pago
     */
    public function setValorPago($valor_pago)
    {
        $this->valor_pago = $valor_pago;
    }


}
