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


//var_dump($dataProvider);
//exit;

?>


<?if($dataProvider != null) {?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'cpf_cliente',
        'nome',
        'telefone',
        [
            'attribute' => 'Status',
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
            'template' => '{view}{delete}',
//            'template' => '{view}{delete} {listar_veiculo}{adicionar_veiculo}',
            'buttons' => [

                //view button
                'adicionar_veiculo' => function ($url, $model) {

                    return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url,
                        [
                            'title' => Yii::t('app', 'Adicionar veículo ao cliente'),
                        ]);
                }, //view button
                'listar_veiculo' => function ($url, $model) {

                    return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', $url,
                        [
                            'title' => Yii::t('app', 'Listar veículo ao cliente'),
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
                }elseif ($action === 'listar_veiculo') {
                    return \yii\helpers\Url::to(['mensal/listar-veiculo', 'cpf' => $model['cpf_cliente']]);
                }
                return '';
            },

        ]
    ],
]); ?>

<?} else {?>
    Sem cliente
<?} ?>

