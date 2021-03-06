<?php

namespace app\controllers;

use Yii;
use app\models\WorkUsers;
use app\models\User;
use app\models\Work;
use yii\helpers\ArrayHelper;
use app\models\WorkUsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * WorkusersController implements the CRUD actions for WorkUsers model.
 */
class WorkusersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all WorkUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->open();
        $user= User::findOne($session->get('__id'));
        if($user['flags']==2 || $user['flags']==1|| !isset($user)){//Проверка на ученика учителя или гостя
            return $this->render('error');
        }
        $searchModel = new WorkUsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WorkUsers model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $session = Yii::$app->session;
        $session->open();
        $user= User::findOne($session->get('__id'));
        if(!isset($user)){//Проверка на ученика учителя или гостя
            return $this->render('error');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new WorkUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        $session->open();
        $user= User::findOne($session->get('__id'));
        if($user['flags']==2 || $user['flags']==1|| !isset($user)){//Проверка на ученика учителя или гостя
            return $this->render('error');
        }
        $model = new WorkUsers();

        $users=  User::find()->all();
        $works= Work::find()->all();
        $items=ArrayHelper::map($users,'id','fio');
        $items_works=ArrayHelper::map($works,'id','title');

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'items'=> $items,
            'model' => $model,
            'items_works' => $items_works,
        ]);
      
    }
    
    /**
     * Updates an existing WorkUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        $session->open();
        $user= User::findOne($session->get('__id'));
        if($user['flags']==2 || $user['flags']==1|| !isset($user)){//Проверка на ученика учителя или гостя
            return $this->render('error');
        }
        $model = $this->findModel($id);

        $users=  User::find()->all();
        $works= Work::find()->all();
        $items=ArrayHelper::map($users,'id','fio');
        $items_works=ArrayHelper::map($works,'id','title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'items'=> $items,
            'model' => $model,
            'items_works' => $items_works,
        ]);
    }

    /**
     * Deletes an existing WorkUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $session = Yii::$app->session;
        $session->open();
        $user= User::findOne($session->get('__id'));
        if($user['flags']==2 || $user['flags']==1|| !isset($user)){//Проверка на ученика? учителя или гостя
            return $this->render('error');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WorkUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WorkUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        
        if (($model = WorkUsers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
