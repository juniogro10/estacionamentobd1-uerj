<?php
/**
 * Created by PhpStorm.
 * User: Mauricio Vicente de Lima Junior
 * Company : Estacionamento
 * Date: 20/05/2017
 * Time: 19:11
 */
use yii\bootstrap\Html;


?>

<div style=" width: 50%;margin: 0 auto; ">
    <h1>Controle</h1>
    <div style="margin-top: 20px">
        <?= Html::a('No Estacionamento', ['controle/lista'], ['class' => 'btn btn-info', 'style' => 'padding:50px;background-color:#191E58']); ?>
        <?= Html::a('Entrada', ['controle/entrada'], ['class' => 'btn btn-xl btn-info', 'style' => 'padding:50px;']); ?>
        <?= Html::a('Saída', ['controle/saida'], ['class' => 'btn btn-warning', 'style' => 'padding:50px;']); ?>
    </div>

    <h1>Mensal</h1>
    <div style="margin-top: 10px">

        <?= Html::a('Mensal', ['mensal/index'], ['class' => 'btn btn-success', 'style' => 'padding:50px;']); ?>
    </div>
</div>


