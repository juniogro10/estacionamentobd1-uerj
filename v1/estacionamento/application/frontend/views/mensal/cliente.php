<?php
/**
 * Created by PhpStorm.
 * User: Mauricio Vicente de Lima Junior
 * Date: 08/06/2017
 * Time: 02:42
 */
use yii\widgets\DetailView;

?>


<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'cpf_cliente',
        'nome',
        'rg',
        [
            'attribute' => 'sexo',
            'value' => function ($model) {

                if($model->sexo == 'm' )
                {
                    return 'Masculino';
                }
                return 'Feminino';
            },
        ],
        'email',
        'data_nascimento',
        'telefone',
        [
            'attribute' => 'ativo',
            'value' => function ($model) {
                if($model->ativo )
                {
                    return 'Ativo';
                }
                return 'Desativado';
            },
        ],
    ],
]);?>
