<?php

namespace backend\models;

use yii\base\Model;
use common\models\User;
use yii\data\ActiveDataProvider;

class UserSearch extends Model
{
    public $id;
    public $username;
    public $name;
    public $surname;
    public $status_id;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'username', 'name', 'surname', 'status_id'], 'safe'],
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find()
            ->select(['user.*'])
            ->andFilterWhere(['ilike', 'username', $this->username])
            ->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'surname', $this->surname])
            ->groupBy(['user.id']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['username' => SORT_ASC],
                'attributes' => [
                    'username',
                    'status_id',
                ]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['ilike', 'username', $this->username]);
        $query->andFilterWhere(['ilike', 'name', $this->name]);
        $query->andFilterWhere(['ilike', 'surname', $this->surname]);
        $query->andFilterWhere([
            User::tableName() . '.id' => $this->id,
            'status' => $this->status_id,
        ]);

        return $dataProvider;
    }
}
