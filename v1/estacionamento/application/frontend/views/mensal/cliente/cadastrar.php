<?php
/* @var $this yii\web\View */
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\Html;

?>
<div>
    <?php $form = ActiveForm::begin(['id' => 'form_cadastro']); ?>


    <?= $form->field($model, 'cpf_cliente')->textInput(['type' => 'number']) ?>
    <?= $form->field($model, 'nome')->textInput()->label('Nome') ?>
    <?= $form->field($model, 'rg')->textInput(['type' => 'number'])->label('RG') ?>
    <?= $form->field($model, 'telefone')->textInput()->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '(99) 99999-9999',
    ]); ?>

<!--    <h2> Opcionais</h2>-->
    <?= $form->field($model, 'dt_nascimento')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '99/99/9999',
    ]); ?>
    <?= $form->field($model, 'sexo')->dropDownList(['0' => 'Feminino', '1' => 'Masculino'],
        ['prompt' => 'Selecionar o Sexo']); ?>
    <?= $form->field($model, 'email')->input('email'); ?>

    <div class="form-group">
        <?= Html::submitButton('Registrar', ['class' => 'btn btn-success', 'name' => 'registrar-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>