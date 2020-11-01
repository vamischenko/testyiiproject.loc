<?php

/** @var \common\models\Publication $model */

$this->title = 'Редактирование новости ' . $model->id;

echo $this->render('_form', ['model' => $model]);
