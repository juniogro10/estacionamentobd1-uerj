<?php

namespace frontend\models;

use common\components\Database;
use Exception;
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

    public $cpf;
    public $nome;
    public $sexo;
    public $data_nascimento;
    public $rg;
    public $telefone;
    public $tipo;
    public $ativo;

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


    public static function findpessoa($cpf)
    {

        try {
            $query = "SELECT * FROM " . Pessoa::tableName() . " WHERE cpf ='" . $cpf . "';";

            $query_result = Database::query_all($query);

            if ($query_result) {

                $model = new Pessoa();
                try {
                    $model->load(['Pessoa' => $query_result[0]]);;

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

    public function atualizar()
    {
//        return true;

        try {
            $query = "UPDATE " . Pessoa::tableName() .
                " SET ativo ='" . $this->getAtivo() . "', nome = '" . $this->getNome() .
                "', rg = '" . $this->getRg() . "', sexo = '" . $this->getSexo() .
                "', data_nascimento = '" . $this->getDtNascimento_sql() .
                "', telefone = '" . $this->getTelefone() . "', tipo = '" . $this->getTipo() . "'  WHERE cpf ='" . $this->getCpf() . "';";

            //Numero de row atualizada
//            var_dump($query);
//            exit;
            $query_result = Database::query_execute($query);

//            var_dump($query_result);
//
//            exit;
            Yii::$app->session->setFlash('success', 'Cliente Atualizado');
            return true;
        } catch (Exception $e) {
            var_dump('erro no try');
            throw new \Exception($e);
        }
    }


    public static function findall()
    {
        $tipo = 0;
        try {
            $query = "SELECT * FROM " . Pessoa::tableName() . " where tipo ='" . $tipo . "';";
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

    public static function findall_new($status = 1)
    {
        try {

            $query = "SELECT * FROM " . Pessoa::tableName() . " p inner join funcionario f on f.cpf_funcionario != p.cpf inner join cliente c on c.cpf_cliente != p.cpf ;";

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
            $query = "INSERT  " . Pessoa::tableName() . " (cpf,nome,sexo,data_nascimento,rg,telefone,tipo,ativo)
             VALUES ('" . $this->getCpf() . "','" . $this->getNome() . "','" . $this->getSexo() . "','" . $this->getDtNascimento_sql() . "','" . $this->getRg() . "','" . $this->getTelefone() . "','" . $this->getTipo() . "','" . $this->getAtivo() . "')";

            $query_result = Database::query_execute($query);

            if ($query_result) {
                Yii::$app->session->setFlash('success', 'Cadastro realizado com sucesso');
                return true;
            }
            Yii::$app->session->setFlash('warning', 'Tente Novamente');
            throw new \Exception('query_result retornando errado');
        } catch (Exception $e) {
            Yii::$app->session->setFlash('warning', 'Não foi possível cadastrar a pessoa.');
            return false;
        }
    }

    /**
     * @return int
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param int $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param string $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return string
     */
    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    /**
     * @param string $data_nascimento
     */
    public function setDataNascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }

    /**
     * @return string
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param string $rg
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    /**
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * @return int
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param int $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return int
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param int $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    /**
     * @return Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param Cliente $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function getDtNascimento_sql()
    {
        return $this->format_date_sql($this->getDataNascimento());
    }

    public function getDtNascimento_brl()
    {
        return $this->format_date_brl($this->getDataNascimento());
    }

    private function format_date_sql($date)
    {
        $timestamp = strtotime($date);
        $mydate = date('Y-m-d', $timestamp);
        return $mydate;
    }

    private function format_date_brl($date)
    {
        $timestamp = strtotime($date);
        $mydate = date('d-m-Y', $timestamp);
        return $mydate;
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
