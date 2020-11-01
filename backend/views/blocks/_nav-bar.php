<?php

use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

NavBar::begin([
    'options' => [
        'class' => 'navbar navbar-light bg-faded navbar-fixed-bottom',
    ],
]);

?>

<div class="pull-left navbar-brand text-muted">
    <?= Html::tag('strong', $this->title) ?>
</div>

<?php if (!empty($buttons)) : ?>
<div class="pull-right btn-group navbar-btn">
    <?php
    foreach ($buttons as $button) {
        $options = isset($button['options']) ? (array)$button['options'] : [];
        echo Html::a(
            $button['label'],
            is_array($button['url']) ? $button['url'] + Yii::$app->getRequest()->getQueryParams() : $button['url'],
            ArrayHelper::merge(['class' => 'btn btn-primary'], $options)
        );
    }
    ?>
</div>
<?php endif; ?>

<?php NavBar::end(); ?>
