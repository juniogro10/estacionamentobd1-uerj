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
        'placa',
        'data_hora_entrada',
        [

            'attribute' => 'Valor até agora',
            'value' => function($model) {

                $date_saida = new DateTime($model['data_hora_entrada']);
                $date_entrada = new DateTime($model['data_hora_saida']);

                $diff = $date_saida->diff($date_entrada);

                $hours = $diff->h;

                if ($diff->i > 0) {
                    $hours++;
                }

                $hours = $hours + ($diff->days * 24);
                $valor_fracao = 10;

                return 'R$ ' .number_format($hours * $valor_fracao, 2, ',', ' ');
            }
        ]
    ],
]); ?>

<?} else {?>
    <h1>Não existe carro cadastrado no momento</h1>
<?} ?>

