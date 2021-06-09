<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WorkUsers;
use app\models\User;
use app\models\Work;

/**
 * WorkUsersSearch represents the model behind the search form of `app\models\WorkUsers`.
 */
class WorkUsersSearch extends WorkUsers
{
    /**
     * {@inheritdoc}
     */
    public $fio;
    public $title;
    public function rules()
    {
        return [
            [['id', 'id_work', 'id_user'], 'integer'],
            [['status','fio','title'], 'safe'],
            // [['fio','work'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$id=null)
    {
        $query = WorkUsers::find();
        $query->joinWith(['work']);
        $query->joinWith(['user']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['updated_at' => SORT_DESC]],
        ]);
        $dataProvider->sort->attributes['fio'] = [
            'asc' => [User::tableName().'.fio' => SORT_ASC],
            'desc' => [User::tableName().'.fio' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['title'] = [
            'asc' => [Work::tableName().'.title' => SORT_ASC],
            'desc' => [Work::tableName().'.title' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_work' =>$id,
            'id_user' => $this->id_user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);
        $query->andFilterWhere(['like', User::tableName().'.fio', $this->fio]);
        $query->andFilterWhere(['like', Work::tableName().'.title', $this->title]);
        if($id!=null){//Проверка на заход с главной страницы или другой
            $query->andFilterWhere(['not like','status', 'Проверенно']);// Удаление из вывода строк с проверенным статусом
        }
        return $dataProvider;
    }
}
