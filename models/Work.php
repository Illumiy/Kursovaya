<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "work".
 *
 * @property int $id
 * @property int $id_teacher
 * @property string $title
 *
 * @property User $teacher
 * @property WorkUsers[] $workUsers
 */
class Work extends \yii\db\ActiveRecord
{
 
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_teacher', 'title'], 'required'],
            [['id_teacher'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['id_teacher'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_teacher' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_teacher' => 'ФИО учителя',
            'title' => 'Название работы',
        ];
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(User::className(), ['id' => 'id_teacher']);
    }

    /**
     * Gets query for [[WorkUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkUsers()
    {
        return $this->hasMany(WorkUsers::className(), ['id_work' => 'id']);
    }
}
