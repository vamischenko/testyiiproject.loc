<?php

use common\models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/** @var backend\models\UserSearch $searchModel */
/** @var User $model */
/* @var ActiveDataProvider $dataProvider */

//Создаем экземпляр класса электронной таблицы
$spreadsheet = new Spreadsheet();
//Получаем текущий активный лист
$sheet = $spreadsheet->getActiveSheet();

// Записываем в ячейку A1 данные
$sheet->setCellValue('A1', 'Hello my Friend!');

$writer = new Xlsx($spreadsheet);
//Сохраняем файл в текущей папке, в которой выполняется скрипт.
//Чтобы указать другую папку для сохранения.
//Прописываем полный путь до папки и указываем имя файла
$writer->save('hello.xlsx');