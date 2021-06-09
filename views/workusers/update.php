<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WorkUsers */

$this->title = 'Обновить Work Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Work Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="work-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'items'=> $items,
        'model' => $model,
        'items_works' => $items_works,
    ]) ?>

</div>
