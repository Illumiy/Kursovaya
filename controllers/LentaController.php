<?php

namespace app\controllers;

use Yii;
use app\models\WorkUsers;
use app\models\Work;
use app\models\User;

class LentaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->open();
        $work = Work::find()->all();
        $user= User::findOne($session->get('__id'));
        if($user['flags']==2){
            return $this->render('error');
        }
        $teacher_works= $user->works;
        $arr_works=array();
        if($teacher_works){
            foreach($teacher_works as $id_work){
                $works_student=WorkUsers::find()->where(['id_work'=> $id_work['id']])->orderBy(['updated_at'=> SORT_DESC])->all();
                foreach($works_student as $one_work){
                    $student_inf=User::findOne($one_work['id_user']);
                    $work_inf=Work::findOne($one_work['id_work']);
                    $arr_works[$one_work['id']]['title']=$work_inf['title'];
                    $arr_works[$one_work['id']]['fio']=$student_inf['fio'];
                    $arr_works[$one_work['id']]['status']=$one_work['status'];
                    $arr_works[$one_work['id']]['update']=$one_work['updated_at'];
                    // s($arr_works);
                }
            }
        }
        usort($arr_works, function ($a, $b){ 
            if ($a['update'] == $b['update']) return 'ds';
            return $a['update'] < $b['update'] ? 1 : -1; 
        });
        // s($arr_works);
        // die;
        
        return $this->render('index', [
            'user' => $user,
            'work' => $work,
            'teach' => $teach,
            'arr_works'=> $arr_works,
        ]);
    }

}
