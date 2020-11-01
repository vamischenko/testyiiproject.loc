<?php

namespace backend\controllers;


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use yii\web\Controller;

class SpreadsheetController extends Controller
{
    public function actionDownload ()
    {
        $spreadsheet = $spreadsheet = new Spreadsheet();;
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="file.xls"');
        $writer->save("php://output");
    }
}