<?php

namespace app\controllers;

class ControleController extends \yii\web\Controller
{
    public function actionEntrada()
    {
        return $this->render('entrada');
    }

    public function actionSaida()
    {
        return $this->render('saida');
    }

}
