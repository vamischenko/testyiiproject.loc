<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use common\models\Company;
use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'surname') ?>
            <?= $form->field($model, 'company_id')
                ->dropDownList(Company::listing($model->company_id), ['prompt' => '---', 'class' => 'form-control']); ?>

            <?php
            echo FileInput::widget([
                'model' => $model,
                'attribute' => 'icon',
                'pluginOptions' => [
                    'initialPreview'=>[
                        Html::img("/uploads/" . $model->icon)
                    ],
                    'overwriteInitial'=>true
                ]
            ]);
            ?>
            <?php echo FileInput::widget([
                'model' => $model,
                'attribute' => 'files[]',
                'options' => ['multiple' => true]
            ]); ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
