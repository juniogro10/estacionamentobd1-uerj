<?php
/**
 * Created by PhpStorm.
 * User: Mauricio Vicente de Lima Junior
 * Date: 08/06/2017
 * Time: 13:45
 */
use kartik\widgets\ActiveForm;
use yii\helpers\Html;

//
//var_dump($dataprovider);
//exit;
?>



<div>
    <h2>Digite o cpf ou primeiro nome do cliente</h2>
    <?php $form = ActiveForm::begin(['id' => 'form']); ?>

    <?= $form->field($model_dynamic, 'cpf')->textInput(['type' => 'number']) ?>

    <?= $form->field($model_dynamic, 'nome')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-success', 'name' => 'buscar-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?if(isset($dataprovider)){?>

    <?= Yii::$app->view->render('lista',['dataProvider' => $dataprovider]); ?>
<?}?>
