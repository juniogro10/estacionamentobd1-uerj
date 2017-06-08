<?php
/**
 * Created by PhpStorm.
 * User: Mauricio Vicente de Lima Junior
 * Date: 08/06/2017
 * Time: 02:53
 */
use yii\grid\GridView;
use yii\widgets\DetailView;

?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'cpf_cliente',
        'nome',
        'telefone',
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Ações',
            'template' => '{view}{delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    return \yii\helpers\Url::to(['mensal/cliente', 'id' => $model['cpf_cliente']]);
                } elseif ($action === 'delete') {
                    return \yii\helpers\Url::to(['mensal/cliente_delete', 'id' => $model['cpf_cliente']]);
                }
            },

        ]
    ],
]); ?>

