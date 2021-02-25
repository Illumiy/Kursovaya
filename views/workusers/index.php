<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Таблица work_users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'status',
            'created_at',
            'updated_at',
            [
                'attribute'=>'id_user',
                'label'=>'Имя пользователя',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getUsernameName();
                },
            ],
            [
                'attribute'=>'id_work',
                'label'=>'Название работы',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getWorkName();
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
