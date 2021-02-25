<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WorkUsers */

$this->title = 'Create Work Users';
$this->params['breadcrumbs'][] = ['label' => 'Work Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items'=> $items,
        'items_works'=> $items_works,
    ]) ?>

</div>
