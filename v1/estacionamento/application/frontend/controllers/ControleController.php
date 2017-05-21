<?php

namespace frontend\controllers;

use common\components\Database;
use frontend\models\TicketRotativo;
use Yii;
use yii\db\Exception;
use yii\helpers\Url;

class ControleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEntrada()
    {
        $model = new TicketRotativo();
        if ($model->load(\Yii::$app->request->post())) {

            try {
                $query = "INSERT INTO " . TicketRotativo::tableName() . " (cpf_funcionario,placa) VALUES ('" . \Yii::$app->user->getId() . "',' " . $model->placa . "')";
                $query_result = Database::query_execute($query);

                if ($query_result) {
                    Yii::$app->session->setFlash('success', 'Entrada Registrada com sucesso');
                    return $this->redirect([Url::to('controle/index')]);
                }
                Yii::$app->session->setFlash('warning', 'Tente Novamente');
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
        return $this->render('entrada', ['model' => $model]);
    }

    public function actionSaida()
    {
        return $this->render('saida');
    }

}
