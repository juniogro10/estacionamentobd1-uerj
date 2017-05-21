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
    <div style="">
        <?= Html::a('Entrada', ['controle/entrada'], ['class' => 'btn btn-xl btn-info']); ?>
        <?= Html::a('Saída', ['controle/saida'], ['class' => 'btn btn-warning']); ?>

    </div>
    <div>
        <?= Html::a('Mensal', ['controle/mensal'], ['class' => 'btn btn-success']); ?>
    </div>
</div>


