<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\models\User;
use app\models\Work;
/**
 * This is the model class for table "work_users".
 *
 * @property int $id
 * @property int $id_work
 * @property int $id_user
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 * @property Work $work
 */
class WorkUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    

    public function behaviors()
    {
        return [
            //Использование поведения TimestampBehavior ActiveRecord
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],

                ],
                'value' => function(){
                    date_default_timezone_set("Europe/Moscow");
                                return date("Y-m-d H:i:s");
                },


            ],

        ];
    }
    public static function tableName()
    {
        return 'work_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_work','file', 'id_user', 'status'], 'required'],
            [['id_work', 'id_user',], 'integer'],
            [['status'], 'string', 'max' => 255],
            [['file'], 'file','skipOnEmpty'=> false, 'extensions'=> 'docx, doc, pdf'],//Правила для расширения файла
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_work'], 'exist', 'skipOnError' => true, 'targetClass' => Work::className(), 'targetAttribute' => ['id_work' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_work' => 'Id работы',
            'id_user' => 'Id пользователя',
            'status' => 'Статус работы',
            'created_at' => 'Создана',
            'updated_at' => 'Обновлена',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
    public function getUsernameName()
    {
        $name_us = $this->user;

        return $name_us ? $name_us->username : '';
    }

    /**
     * Gets query for [[Work]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWork()
    {
        return $this->hasOne(Work::className(), ['id' => 'id_work']);
    }
    public function getWorkName()
    {
        $name_wo = $this->work;

        return $name_wo ? $name_wo->title : '';
    }
     //Загрузка файлов
     public function upload()
     {
         if ($this->validate()) {
            $path = 'uploads/' .md5(uniqid(rand(),true)). '.' . $this->file->extension;//Сохранение пути
            $this->file->saveAs($path);
            $this->file=$path;
            return true;
         } else {
             return false;
         }
     }
}
