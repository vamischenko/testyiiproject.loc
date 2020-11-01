<?php

/** @var \common\models\User $model */

$this->title = $this->params['h1'] = 'Добавить пользователя';

echo $this->render('_form', ['model' => $model]);
