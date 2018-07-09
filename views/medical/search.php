<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<?php
$this->title = 'Search';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([ 
    'id' => 'active-form',
    'options' => [
		'class' => 'form-horizontal',
		'enctype' => 'multipart/form-data'
	],
]) ?>
<div class="form-search">
	<?= $form->field($key, 'key')->textInput(['placeholder' => "Enter name or Employee ID",'style'=>'border-radius: 30px; width:98.2%; height:40px; background-image:url("searchicon.png" width=50px height=auto); background-repeat:no-repeat;'])

	                    ->label('ค้นหาประวัติผู้ป่วย',['class'=>'label-class'])
	     ?>                               
	        <?= Html::submitButton('Search', ['class' => 'btn btn-success2',
	        	'data' => [
	                'method' => 'post',
	            ]]) ?>                
	<?php ActiveForm::end();?>
</div>