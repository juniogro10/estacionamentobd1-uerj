<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

?>
<div style=" width: 50%;margin: 0 auto; ">
    <h1> Cliente</h1>
    <div style="margin-top: 20px">

        <?= Html::a('Buscar', ['mensal/cliente-buscar'], ['class' => 'btn btn-xl btn-info ', 'style' => 'padding:50px;background-color:#191E58']); ?>
        <?= Html::a('Listar', ['mensal/lista'], ['class' => 'btn btn-xl btn-info', 'style' => 'padding:50px;']); ?>

        <?= Html::a('Cadastrar', ['mensal/cadastrar'], ['class' => 'btn btn-warning', 'style' => 'padding:50px;']); ?>

    </div>

<!--    <h1>Pagamento</h1>-->
<!--    <div style="margin-top: 10px">-->
<!--        --><?//= Html::a('Registrar Pagamento', ['mensal/pagamento'], ['class' => 'btn btn-success', 'style' => 'padding:50px;']); ?>
<!--    </div>-->
</div>
