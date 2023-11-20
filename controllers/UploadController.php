<?php

namespace app\controllers;

use app\models\FileData;
use app\models\FileName;
use app\models\Product;
use app\models\UploadForm;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Date;
use Shuchkin\SimpleXLSX;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class UploadController extends Controller
{
    public function actionIndex()
    {

        $model = new UploadForm();
        $sum = null;

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->upload()) {

                $xls = SimpleXLSX::parseFile($model->fileNamePath);

                $products = Product::find()->all();


                if (!$products) {
                    foreach ($xls->rows() as $key => $item) {
                        if (!empty($item[0])) {
                            $product = new Product();
                            $product->line_number = $key + 1;
                            $product->date = Yii::$app->formatter->asDate($item[1], 'php:Y-m-d H:i:s');
                            $product->price = $item[2];
                            $product->save();
                            $sum += (int)$item[2];
                        }
                    }
                } else {

                    foreach ($xls->rows() as $key => $item) {

                        $arrLineNumber = [];
                        foreach ($products as $product) {
                            $arrLineNumber[] = $product['line_number'];
                        }
                        if (!empty($item[0])) {
                            if (in_array($key + 1, $arrLineNumber)) {
                                $p = Product::findOne(['line_number' => $key + 1]);
                                $p->line_number = $key + 1;
                                $p->date = Yii::$app->formatter->asDate($item[1], 'php:Y-m-d H:i:s');
                                $p->price = $item[2];
                                $p->save();
                                $sum += (int)$item[2];
                            } else {
                                $p = new Product();

                                $p->line_number = $key + 1;
                                $p->date = Yii::$app->formatter->asDate($item[1], 'php:Y-m-d H:i:s');
                                $p->price = $item[2];
                                $p->save();
                                $sum += (int)$item[2];
                            }
                        }

                    }
                }

                $file_name = new FileName();

                $file_name->title = $model->fileName;
                $file_name->save();

                foreach ($xls->rows() as $item) {
                    if (!empty($item[0])) {
                        $file_data = new FileData();

                        $file_data->line_number = $item[0];
                        $file_data->date = Yii::$app->formatter->asDate($item[1], 'php:Y-m-d H:i:s');
                        $file_data->price = $item[2];

                        $file_name = FileName::find()->select(['id'])->where(['title' => $model->fileName])->one();
                        $file_data->file_id = $file_name->id;

                        $file_data->save();
                    }
                }

                \Yii::$app->session->setFlash('success', 'Файл загружен!!!');

                $model = new UploadForm();
                return $this->redirect(['index', 'sum' => $sum]);

            } else {
                \Yii::$app->session->setFlash('error', 'Ошибка загрузки!!!');
            }
        }

        return $this->render('index', compact('model'));
    }

}