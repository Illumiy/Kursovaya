<?php

namespace app\controllers;

use Yii;
use app\models\WorkUsersSearch;
use app\models\WorkUsers;
use app\models\Work;
use app\models\User;

class LentaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->open();
        $user= User::findOne($session->get('__id'));
        if($user['flags']==2 || !isset($user)){//Проверка на ученика или гостя
            return $this->render('error');
        }
        $teacher_works = array();
        foreach($user->works as $id_work){
            $teacher_works[]=$id_work['id'];
        }
        $searchModel = new WorkUsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $teacher_works);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDownload($path) {
        if (file_exists($path)) {
            return \Yii::$app->response->sendFile($path);
        } 
        throw new \Exception('File not found');
     }

}
