<?php

namespace frontend\controllers;

use frontend\models\Cliente;

class MensalController extends \yii\web\Controller
{
    public function actionCadastrar()
    {

        $model = new Cliente();

        if($model->load(\Yii::$app->request->post()))
        {
//            Carregando load


            var_dump('oi');
            try{
                var_dump($model->cadastrar());

            }
            catch(\Exception $e)
            {
                var_dump($e->getMessage());

            }
            exit();
        }
        return $this->render('cadastrar',['model' => $model]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
