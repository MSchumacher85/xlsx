<?php

namespace app\commands;

use yii\console\Controller;

class MailController extends Controller
{
    public function actionIndex(){

        $dir = 'web/uploads/' . date("Y-m-d") . '/';

        $count_file_upload_today = is_dir($dir) ? (count(scandir($dir)) - 2) : 0;

        \Yii::$app->mailer->compose()
            ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
            ->setTo([\Yii::$app->params['adminEmail']])
            ->setSubject("Сегодня загружено : {$count_file_upload_today} файла")
            ->send();
    }
}