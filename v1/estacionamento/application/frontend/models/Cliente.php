<?php

namespace frontend\models;

use common\components\Database;
use Exception;
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


    public static function findcliente($cpf)
    {

        try {
            $query = "SELECT * FROM " . Cliente::tableName() . " WHERE cpf_cliente ='" . $cpf . "';";

            $query_result = Database::query_all($query);

            if ($query_result) {

                $model = new Cliente();
                try {
                    $model->load(['Cliente' => $query_result[0]]);;

                    return $model;

                } catch (\Exception $e) {

                    var_dump("deu ruim");
                    var_dump($e->getMessage());
                    exit;
                }
            } else {
                return false;
            }

        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }

    public static function findcliente_info($cpf)
    {

        try {
            $query = "SELECT * FROM " . Cliente::tableName() . " c inner join " . Pessoa::tableName() . " p on p.cpf = c.cpf_cliente WHERE cpf_cliente ='" . $cpf . "';";

            $query_result = Database::query_all($query);

            if ($query_result) {
                $model = new ClienteInfo();
//                $model = new Cliente();
                try {
//                    $model->load(['Cliente' => $query_result[0]]);;
                    $model->setCpfCliente($query_result[0]['cpf_cliente']);
                    $model->setEmail($query_result[0]['email']);
                    $model->setCnh($query_result[0]['cnh']);
                    $model->setCpf($query_result[0]['cpf']);
                    $model->setNome($query_result[0]['nome']);
                    $model->setSexo($query_result[0]['sexo']);
                    $model->setDataNascimento($query_result[0]['data_nascimento']);
                    $model->setRg($query_result[0]['rg']);
                    $model->setTelefone($query_result[0]['telefone']);
                    $model->setTipo($query_result[0]['tipo']);
                    $model->setAtivo($query_result[0]['ativo']);
//                    $model->setSexo($query_result[0]['sexo']);
//                    $model->setSexo($query_result[0]['sexo']);
                    return $model;

                } catch (\Exception $e) {

                    var_dump("deu ruim");
                    var_dump($e->getMessage());
                    exit;
                }
            } else {
                return false;
            }

        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }

    public static function buscartodosclienteporcpf($cpf)
    {

        try {
//            $query = "SELECT * FROM " . Cliente::tableName() . " WHERE cpf_cliente like '" . $cpf . "%' ORDER BY cpf_cliente DESC;";
            $query = "SELECT * FROM " . Cliente::tableName() . " c inner join " . Pessoa::tableName() . " p on p.cpf = c.cpf_cliente
             WHERE cpf_cliente like '" . $cpf . "%'  ORDER BY cpf_cliente DESC ;";

            $query_result = Database::query_all($query);

            if ($query_result) {
                return $query_result;
            } else {
                return false;
            }

        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }

    public static function buscartodosclientepornome($nome)
    {

        try {
//            $query = "SELECT * FROM " . Cliente::tableName() . " WHERE nome like '" . $nome . "%' ORDER BY cpf_cliente DESC;";
            $query = "SELECT * FROM " . Cliente::tableName() . " c inner join " . Pessoa::tableName() . " p on p.cpf = c.cpf_cliente
             WHERE p.nome like '" . $nome . "%'  ORDER BY cpf_cliente DESC ;";


            $query_result = Database::query_all($query);

            if ($query_result) {
                return $query_result;
            } else {
                return false;
            }

        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }


    public static function findall($status = 1)
    {
        try {
            $query = "SELECT * FROM " . Cliente::tableName() . " c INNER JOIN " . Pessoa::tableName() . " p ON p.cpf = c.cpf_cliente " . " WHERE ativo = '" . $status . "' and tipo = '0';";

            $query_result = Database::query_all($query);

            if ($query_result) {
                return $query_result;
            } else {
                return false;
            }

        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }

    public function cadastrar()
    {
        try {
            $query = "INSERT  " . Cliente::tableName() . " (cpf_cliente,email,cnh)
             VALUES ('" . $this->getCpfCliente() . "','" . $this->getEmail() . "','" . $this->getCnh() . "')
              ON DUPLICATE KEY UPDATE email = '" . $this->getEmail() . "'";



            try {
                $query_result = Database::query_execute($query);
                if($query_result)
                {
                    Yii::$app->session->setFlash('success', 'Cadastro realizado com sucesso');
                }
            } catch (Exception $e) {
                throw new Exception($e);
            }
            return true;
//            }
        } catch (Exception $e) {
            Yii::$app->session->setFlash('warning', 'Tente Novamente');
//            throw new \Exception('query_result retornando errado');

            return false;
            throw new \Exception($e);
        }
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
