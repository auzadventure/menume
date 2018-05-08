<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model app\models\Menus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cusine')->dropDownList($model->cusineA()) ?>

    <?= $form->field($model, 'meal')->dropDownList($model->mealA())  ?>

    <?= $form->field($model, 'des')->widget(TinyMce::className(), [
				'options' => ['rows' => 15],
				'language' => 'en',
				'clientOptions' => [
					'plugins' => [],
					'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
				]
				]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

	<?= $form->errorSummary($model); ?>
	
    <?php ActiveForm::end(); ?>

</div>
