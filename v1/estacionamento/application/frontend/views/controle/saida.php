<?php
/* @var $this yii\web\View */

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h1>controle/saida</h1>

<div>
    <?php $form = ActiveForm::begin(['id' => 'form_saida']); ?>

    <?= $form->field($model,
        'placa')->textInput(['autofocus' => true])->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => 'aaa-9999',
    ]) ?>

<!--    --><?php //echo $form->hiddenField($model, 'data_hora_saida'); ?>
    <?php echo $form->field($model, 'data_hora_saida')->hiddenInput(['value'=> $model->data_hora_saida])->label(false);?>
    <?php echo $form->field($model, 'valor_pago')->hiddenInput(['value'=> $model->valor_pago])->label(false);?>
<!--    --><?php //echo $form->hiddenField($model, 'valor_pago'); ?>

    <div class="form-group">
        <?= Html::submitButton('Consultar', ['class' => 'btn btn-success', 'name' => 'registrar-button']) ?>
    </div>

    <?if(isset($saida_valor)){?>

        Valor : <?= $saida_valor?>
        <div class="form-group">
            <?= Html::submitButton('Pagar', ['class' => 'btn btn-success', 'name' => 'pagar-button']) ?>
        </div>
    <?}?>
    <?php ActiveForm::end(); ?>
</div>