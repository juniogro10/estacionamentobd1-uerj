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

            $check_plate = TicketRotativo::findplaca($model->getPlaca());

            if($check_plate)
            {
                if($check_plate->getDataHoraSaida() == null)
                {
                    Yii::$app->session->setFlash('warning', 'Emplacamento já estacionado');
                    return $this->render('entrada', ['model' => $model]);
                }
            }
            try {
                $model->entrada();
                return $this->redirect([Url::to('controle/index')]);
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }

        return $this->render('entrada', ['model' => $model]);
    }

    public function actionSaida()
    {
        $model = new TicketRotativo();

        if (Yii::$app->request->post()) {

//          Carregamento dos input enviado para o model
            $model->load(Yii::$app->request->post());

//          Busca do model pelo a placa informada
            $model_check = TicketRotativo::findplaca(Yii::$app->request->post('TicketRotativo')['placa']);

//          Verificação se é valido
            if ($model_check) {
//              Emplacamento já pago
                if($model_check->valor_pago != '0' )
                {
                    Yii::$app->session->setFlash('warning', 'Emplacamento já pago');
                    return $this->render('saida', ['model' => $model]);
                }

//              Registra a hora de saida
                $model_check->setDataHoraSaida();

//              Calcula o valor a ser pago
                $saida_valor = $model_check->saida_valor();

//              Verificação Mensal
                if($model->mensal())
                {
                    $saida_valor = 0;
                }

                $model_check->setValorPago($saida_valor);


//              Botão do submit
                $bota_pagar = Yii::$app->request->post('pagar-button');


                if (isset($bota_pagar)) {


//                  Registra os valores no banco
//
//                  Erro no salvamento
                    if (!$model_check->atualizar()) {
                        Yii::$app->session->setFlash('warning', 'Tente Novamente');
                        return $this->render('saida', ['model' => $model]);
                    }

//                 Redirecionamento para o controller controle
                    return $this->redirect(Url::to('../controle/index'));
                }
//
                return $this->render('saida', ['model' => $model_check, 'saida_valor' => $saida_valor]);
            }

            Yii::$app->session->setFlash('warning', 'Emplacamento não encontrado');
        }
        return $this->render('saida', ['model' => $model]);
    }

}
