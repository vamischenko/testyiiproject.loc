<?php

namespace backend\controllers;

use backend\actions\Create;
use backend\actions\Set;
use backend\actions\Update;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;
use yii2tech\admin\actions\Delete;
use yii2tech\admin\actions\Index;
use Yii;
use yii\web\Response;

/**
 * Class Controller
 * @package backend\controllers
 */
class Controller extends \yii\web\Controller
{
    public $searchModelClass;
    public $modelClass;
    public $actions = [];

    /**
     * @return array
     */
    public function actions()
    {
        return array_merge([
            'index' => [
                'class' => Index::class,
                'newSearchModel' => function () {
                    return new $this->searchModelClass;
                },
            ],
            'create' => [
                'class' => Create::class,
            ],
            'update' => [
                'class' => Update::class,
            ],
            'delete' => [
                'class' => Delete::class,
            ],
            'set' => [
                'class' => Set::class
            ]
        ], $this->actions);
    }

    /**
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        /** @var \yii\db\ActiveRecord $class */
        $class = $this->modelClass;
        if (($model = $class::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return mixed
     */
    public function newModel()
    {
        return new $this->modelClass;
    }
}
