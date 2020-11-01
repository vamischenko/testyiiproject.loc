<?php

namespace backend\models;

use common\models\Company;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CompanySearch extends Model
{
    public $id;
    public $name;
    public $status_id;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'name', 'status_id'], 'safe'],
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Company::find()
            ->select(['company.*'])
            ->andFilterWhere(['ilike', 'name', $this->name])
            ->groupBy(['company.id']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
                'attributes' => [
                    'name',
                    'status_id',
                ]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['ilike', 'name', $this->name]);
        $query->andFilterWhere([
            Company::tableName() . '.id' => $this->id,
            'status' => $this->status_id,
        ]);

        return $dataProvider;
    }

}