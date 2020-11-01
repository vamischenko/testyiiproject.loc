<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var \common\models\Company $model
 * @var ActiveForm $form
 * @var yii\web\View $this
 */


$form = ActiveForm::begin(['enableClientValidation' => false]);
echo $form->errorSummary($model);

echo $form->field($model, 'name')->textInput();
echo $form->field($model, 'status_id')->dropDownList($model::status());
echo $this->render('//blocks/_save-bar', [
    'model' => $model
]);

ActiveForm::end();
