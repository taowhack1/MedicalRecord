<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\db\ActiveRecord;

/* @var $this yii\web\View */
/* @var $model app\models\Donatur */
?>

<h2 align="center">Form Donatur</h2>

<?php $form = ActiveForm::begin(['layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
            'label' => 'col-sm-4',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
            'button' => 'col-sm-4'
        ],
    ],
    ]); ?>

<?= $form->field($model, 'kode_donatur')->textInput(['readonly' => true, 'style'=>'width:100px']) ?>
<?= $form->field($model, 'nama_donatur')->textInput(['style'=>'width:350px']) ?>
<?= $form->field($model, 'alamat')->textArea(['rows' => 3, 'style'=>'width:350px']) ?>
<?= $form->field($model, 'telepon')->textInput(['style'=>'width:300px']) ?>
<div class="form-group">
    <div class="col-sm-offset-4">
<?= Html::submitButton('Simpan', ['class'=> 'btn btn-primary']) ?>

<?php
echo "&nbsp";
echo "&nbsp"; 
echo Html::a('Keluar', ['index'],[
	'class'=>'btn btn-success',
	'onclick' =>'$("#donaturModal").modal("hide");
	return false;'
	]);
?>
    </div>
</div>
<?php ActiveForm::end();?>