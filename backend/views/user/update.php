<?php

/** @var \common\models\User $model */

$this->title = $this->params['h1'] = 'Редактирование пользователя ' . $model->name;

echo $this->render('_form', ['model' => $model]);
