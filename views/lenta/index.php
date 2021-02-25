<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<h1>Лента уведомлений</h1>

<p>
   <?php
//    $arr= array(
//        0 => Html::a(Html::encode($arr_works['title']), Url::to(['view', 'id' => $arr_works['title']])),
//        1 => Html::a(Html::encode($arr_works['fio']), Url::to(['view', 'id' => $arr_works['title']])),
//    )
    if($arr_works){
        $provider  = new ArrayDataProvider([
            'allModels' => $arr_works,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['updated_at'],
            ],
           
        ]);
        echo GridView::widget([
            'dataProvider' => $provider ,
            'columns' => [
                [
                    'attribute' => 'title',
                    'value' => function ($arr_works) {
                        return Html::a(Html::encode($arr_works['title']), Url::to(['../workusers/view', 'id' => 1]));
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'fio',
                    'value' => function ($arr_works) {
                        return Html::a(Html::encode($arr_works['fio']), Url::to(['../workusers/view', 'id' => 1]));
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'update',
                    'value' => function ($arr_works) {
                        return Html::a(Html::encode(substr($arr_works['update'],0,-7)), Url::to(['../workusers/view', 'id' => 1]));
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'status',
                    'value' => function ($arr_works) {
                        return Html::a(Html::encode($arr_works['status']), Url::to(['../workusers/view', 'id' => 1]));
                    },
                    'format' => 'raw',
                ],
            ],
        ]);
    }else{
        echo "Нету работ";
    }
    
   ?>
</p>
