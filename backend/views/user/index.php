<?php
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use common\models\User;
use yii\helpers\Html;

/* @var ActiveDataProvider $dataProvider */
/* @var $this yii\web\View */
/** @var backend\models\UserSearch $searchModel */
$model = new User();
$this->title = 'Users';
echo GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            'name',
            'surname',
            [
                'attribute' => 'status_id',
                'filter' => User::status(),
                'value' => function (User $model) {
                    return User::status()[$model->status];
                }
            ],
            [
                'attribute' => 'company_id',
                'value' => function (User $model) {
                    return $model->company->name ?? '';
                }
            ],
            [
                'class' => \yii2tech\admin\grid\ActionColumn::class,
                'template' => '{update} {delete}',
            ]
        ]
    ]
);

echo Html::a('Сохранить в Excel', ['spreadsheet/download']);
echo $this->render('/blocks/_export.php', ['buttons' => [
    ['label' => 'Сохранить в Excel']
], 'searchModel' => $searchModel, 'model' => $model, 'dataProvider' => $dataProvider]);

echo $this->render('/blocks/_nav-bar.php', ['buttons' => [
    ['label' => 'Создать', 'url' => ['create']]
]]);
?>

