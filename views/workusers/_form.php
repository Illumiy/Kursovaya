<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WorkUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $params = [
            'prompt' => 'Укажите автора записи'
        ];
        $params2 = [
            'prompt' => 'Укажите работу записи'
        ];
    ?>
    <?= $form->field($model, 'id_work')->dropDownList($items,$params);?>
    <?= $form->field($model, 'id_user')->dropDownList($items,$params);?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
