<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

use app\assets\GentellaAsset;
GentellaAsset::register($this);
?>
<h1>Лента уведомлений</h1>

<p>
Вам показаны, не проверенные вами работы<br>
   <?php
//    Pjax::begin();
    echo \yiister\gentelella\widgets\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover' => true,
        'columns' => [
            [// Столбец с Названием
                'attribute' => 'title',
                'label' => 'Название работы', 
                'value' => function ($data) {
                    return Html::a(Html::encode($data->work->title), Url::to(['work/view', 'id' => $data->work->id]), ['class'=> 'a-my']);
                },
                'format' => 'raw',
            ],
            ['attribute' => 'fio','label' => 'ФИО студента', 'value'=>'user.fio'],// Столбец с ФИО
            [// Столбец с файлами
                'attribute' => 'Ссылка на файл',
                'label' => 'Файл работы',
                'value' => function ($data) {
                    return Html::a(Html::encode('Файл'), Url::to(['download', 'path' => $data->file]), ['class'=> 'a-my']);
                },
                'format' => 'raw',
            ],
            [// Столбец с временем создания
                'attribute' => 'created_at',
                'label' => 'Время сдачи', 
                'value' => function ($data) {
                    return Html::tag('div',Html::encode(substr($data->created_at, 0, -7)));//Удаление нулей из записи времени
                },
                'format' => 'raw',
            ],
            [// Столбец с временем обновления
                'attribute' => 'updated_at',
                'label' => 'Время обновления', 
                'value' => function ($data) {
                    return Html::tag('div',Html::encode(substr($data->updated_at, 0, -7)));//Удаление нулей из записи времени
                },
                'format' => 'raw',
            ],
           
        ],
    ]); 
//    Pjax::end();
   ?>
</p>
