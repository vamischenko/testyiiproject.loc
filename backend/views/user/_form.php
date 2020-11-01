<?php

use common\models\Company;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var common\models\User $model
 * @var yii\web\View $this
 */

$form = ActiveForm::begin();
echo $form->errorSummary($model);

?>

<div class="row">
    <div class="col-lg-4">
        <?= $form->field($model, 'username')->textInput(); ?>
        <?= $form->field($model, 'password')->textInput(); ?>
        <?= $form->field($model, 'name')->textInput(); ?>
        <?= $form->field($model, 'surname')->textInput(); ?>
        <?= $form->field($model, 'status_id')->dropDownList($model::status()); ?>
        <?= $form->field($model, 'company_id')
            ->dropDownList(Company::listing($model->company_id), ['prompt' => '---', 'class' => 'pen-name-id form-control']); ?>
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
    </div>
</div>

<?php

echo $this->render('/blocks/_save-bar', ['model' => $model]);
ActiveForm::end();
