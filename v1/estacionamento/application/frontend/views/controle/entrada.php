<?php
/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<h1>controle/entrada</h1>

<div>
    <?php $form = ActiveForm::begin(['id' => 'form']); ?>

    <?= $form->field($model, 'placa')->textInput(['autofocus' => true])->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => 'aaa-9999',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Registrar', ['class' => 'btn btn-success', 'name' => 'registrar-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>