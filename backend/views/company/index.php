<?php

use backend\models\CompanySearch;
use common\models\Company;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii2tech\admin\grid\ActionColumn;

/**
 * @var View $this
 * @var CompanySearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Новости';

echo GridView::widget(
    [
        'id' => 'publication-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'title',
                'value' => function (Company $model) {
                    return $model->name;
                },
                'format' => 'raw'
            ],
            'created_at:datetime',
            [
                'attribute' => 'status',
                'value' => function (Company $model) {
                    return $model->isActive ? Html::tag('span', null, ['class' => 'fa fa-2x fa-check text-success']) : Html::tag('span', null, ['class' => 'fa fa-2x fa-minus text-danger']);
                },
                'filter' => Company::status(),
                'format' => 'raw'
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{update} {delete}',
            ]
        ]
    ]
);
echo $this->render('/blocks/_nav-bar.php', ['buttons' => [
    ['label' => 'Создать', 'url' => ['create']]
]]);
