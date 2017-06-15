<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'funcionario';
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($cpf)
    {

        return self::findByCpf($cpf);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByCpf($cpf)
    {
        $query = 'select * from ' . \frontend\models\Funcionario::tableName() . ' where cpf_funcionario = ' . $cpf;

        $query_result = \common\components\Database::query_all($query);

//        var_dump($query_result);


        if (empty($query_result)) {
//            var_dump($query);
//            var_dump('vazio');
//            exit;
            return null;
        }

//        Criação de objeto para utilização na session
        $user = new User();
        try {
            $user->cpf_funcionario = $query_result[0]['cpf_funcionario'];
            $user->senha = $query_result[0]['senha'];
//            $user->nome = $query_result[0]['nome'];
//            $user->rg = $query_result[0]['rg'];
//            $user->sexo = $query_result[0]['sexo'];
//            $user->dt_nascimento = $query_result[0]['dt_nascimento'];
//            $user->telefone = $query_result[0]['telefone'];
//            $user->tipo = $query_result[0]['tipo'];
//            $user->load(['User' => $query_result[0]]);
//            var_dump($query_result);
//            exit;

//            var_dump($user);
//            exit;
            return $user;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
//        return $query_result[0];
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->cpf_funcionario;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
//        Não existe chave de autentição
        return true;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return true;
//        return $this->getAuthKey() === $authKey;
    }
}