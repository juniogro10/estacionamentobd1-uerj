<?php
namespace common\models;


use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $cpf;
    public $password;
    public $rememberMe = true;
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['cpf', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpf' => 'CPF',
            'password' => 'Senha',
            'rememberMe' => 'Salvar dados'

        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
//          Simples comparação do password , necessario um hash??
            if (!($user) || !($user['senha'] == $this->password)) {

                $this->addError($attribute, 'Username ou Senha Incorreto');
            }
        }
    }
    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if (Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0)) {
                Yii::$app->session->setFlash('success', 'Login Realizado com sucesso');
                return true;
            }
            return false;
        } else {
            return false;
        }
    }
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByCpf($this->cpf);
        }
        return $this->_user;
    }
}
