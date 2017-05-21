<?php

namespace app\modules\app;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\app\controllers';

    public $layout='main';




    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','teste', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [

                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    //Muda o layout padrao qdo tenta acessar uma pagina que nao existe e ao mesmo tempo n�o est� logado
    public function beforeAction($action)
    {
        if (($action->id == 'error') && (\Yii::$app->user->isGuest)) {
            $this->layout = '@app/views/layouts/main.php';
        }
        return parent::beforeAction($action);
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function init()
    {
        parent::init();

        \Yii::$app->errorHandler->errorAction = 'app/default/error';
        // custom initialization code goes here
    }
}
