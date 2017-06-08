<?php
/**
 * Created by PhpStorm.
 * User: Mauricio Vicente de Lima Junior
 * Date: 08/06/2017
 * Time: 02:53
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'cpf_cliente',
        'nome',
        'telefone',
        [
            'attribute' => 'ativo',
            'value' => function ($model) {

                if($model['ativo'] )
                {
                    return 'Ativo';
                }
                return 'Desativado';
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Ações',
            'template' => '{view}{delete} {adicionar_veiculo}',
            'buttons' => [

                //view button
                'adicionar_veiculo' => function ($url, $model) {

                    return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url,
                        [
                            'title' => Yii::t('app', 'Adicionar veículo ao cliente'),
                        ]);
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    return \yii\helpers\Url::to(['mensal/cliente', 'cpf' => $model['cpf_cliente']]);
                } elseif ($action === 'delete') {
                    return \yii\helpers\Url::to(['mensal/cliente-delete', 'cpf' => $model['cpf_cliente']]);
                }elseif ($action === 'adicionar_veiculo') {
                    return \yii\helpers\Url::to(['mensal/adicionar-veiculo', 'cpf' => $model['cpf_cliente']]);
                }
            },

        ]
    ],
]); ?>

