<?php

namespace frontend\controllers;

use frontend\models\Cliente;
use Yii;
use yii\data\ArrayDataProvider;

class MensalController extends \yii\web\Controller
{
    public function actionCadastrar()
    {

        $model = new Cliente();

        if($model->load(\Yii::$app->request->post()))
        {
//            Carregando load

            try{
                if($model->cadastrar())
                {
                    return $this->redirect(['mensal/cliente' , 'cpf' => $model->getCpfCliente()]);
                }
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

    public function actionCliente($cpf)
    {

        $model = Cliente::findcliente($cpf);

        if($model)
        {
//            if(Yii::$app->request->post())
//            {
//                var_dump('Post chegando');
//            }

            return $this->render('cliente',['model'=> $model]);
        }
        Yii::$app->session->setFlash('warning', 'CPF não localizado');
        return $this->redirect(['mensal/index']);


        var_dump($cpf);
        exit;
    }

    public function actionLista()
    {

        $model = Cliente::findall();


//        var_dump($model);
//        exit;

        $provider = new ArrayDataProvider([
            'allModels' => $model,
            'sort' => [
                'attributes' => ['cpf_cliente', 'nome', 'telefone'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('lista',['dataProvider'=> $provider]);

    }
}
