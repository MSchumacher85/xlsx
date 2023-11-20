<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var \app\models\Product $model
 */
?>

<?php if(isset($_GET['sum'])) echo "Сумма : {$_GET['sum']}"?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Загрузить файл', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>