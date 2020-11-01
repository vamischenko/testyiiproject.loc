<?php

use yii\bootstrap\NavBar;
use yii\helpers\Html;

NavBar::begin([
    'options' => [
        'class' => 'navbar navbar-light bg-faded navbar-fixed-bottom',
    ],
]);

?>

<div class="pull-left navbar-brand text-muted">
    <?= Html::tag('strong', $this->title) ?>
</div>


<div class="pull-right btn-group navbar-btn">
    <?php
    echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);
    echo Html::submitButton('Сохранить и остаться', [
        'class' => 'btn btn-primary',
        'name' => 'stay',
        'value' =>1]);
    ?>
</div>

<?php if(!empty($model->route)) : ?>
    <a class="eye-link" href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl($model->route) ?>" target="_blank"><span class="fa fa-2x fa-eye text-dark"></a>
<?php endif; ?>

<?php NavBar::end(); ?>

