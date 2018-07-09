<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
?>

<?php $form = ActiveForm::begin([
]);
$this->title = 'Employee';
$this->params['breadcrumbs'][] = ['label' => 'Search', 'url' => ['search']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3">
	<div class="w3-sidebar"> 
		  	<div class="photo">
		  		<?php echo Html::img('@web/assets/24be5741/employee.jpg') ?>
		  	</div>
		    <div class="col-xs-11 col-md-11 col-lg-11 col-sm-11" style="margin-left:2%">
		       <?= $form->field($key, 'Em_ID')->textInput() ?>
		    </div>
		    <div class="col-xs-11 col-md-11 col-lg-11 col-sm-11" style="margin-left:2%">
		       <?= $form->field($key, 'Em_fName')->textInput() ?>
		    </div>
		    <div class="col-xs-11 col-md-11 col-lg-11 col-sm-11" style="margin-left:2%">
		        <?= $form->field($key, 'Em_lName')->textInput() ?>
		    </div>
		    <div class="col-xs-11 col-md-11 col-lg-11 col-sm-11" style="margin-left:2%">
		       <?= $form->field($key, 'Em_Mobile')->textInput() ?>
		    </div>
		    <div class="col-xs-11 col-md-11 col-lg-11 col-sm-11" style="margin-left:2%">
		        <?= $form->field($key, 'Em_IDCard')->textInput() ?>
		    </div>
		    <div class="col-xs-11 col-md-11 col-lg-11 col-sm-11" style="margin-left:2%">
		 	<?= $form->field($key, 'Em_BirthDate')->widget(DatePicker::classname(), [
		        'language' => 'th',
		        'dateFormat' => 'yyyy-MM-dd',
		        'clientOptions'=>[
		          'changeMonth'=>true,
		          'changeYear'=>true,
		        ],
		        'options'=>['class'=>'form-control']
		      ]) ?>
			</div>
		
	</div>
</div>

<div class="col-xs-9 col-md-9 col-lg-9 col-sm-9">
	<div class="row">
		<div class="col-xs-4 col-md-4 col-lg-4 col-sm-4">
			<h2>ประวัติการรักษา</h2>
		</div> 

		<div class="col-md-1">
				        <?= Html::submitButton('Add', ['class' => 'btn btn-success2',
		        	'data' => [
		                'method' => 'post',
		            ]]) ?>  
		            <?= Html::a('Create TR', ['create','Em_ID'=>$key->Em_ID], ['class' => 'btn btn-success']) ?>
		</div>
	</div>
	<?php $index = 0;?>
	<?php foreach ($trEm as $value){?>
		<div class="row">
			<div class="row col-xs-11 col-md-11 col-lg-11 col-sm-11" style="border-style: solid; margin-left: 5px;
		  border-width: 5px 5px 5px 5px; width: 90%; height: 180px;">
			  	<div class="row">
			  		<div class="col-md-2">
			  			<b>เลขที่บันทึก</b><br>&nbsp;&nbsp;<?= $value->TR_ID ?>
			    		
			    	</div>
			  		<div class="col-md-8"></div>
			  		<div class="col-md-2" style="color: red; padding-top: 3px; padding-right:5px;">
			  			<?= Html::a('ลบ', ['delete', 'id' => $value->TR_ID,'Em_ID'=>$value->Employee_Em_ID], [
				            'class' => 'glyphicon glyphicon-trash aria-hidden=tru',
				            'data' => [
				                'confirm' => 'Are you sure you want to delete this item?',
				                'method' => 'post',
				            ],
				        ])
				         ?> | 
			  			<?= Html::a('แก้ไข', ['/medical/update','id'=>$value->TR_ID], ['class'=>'glyphicon glyphicon-cog aria-hidden=true']) ?>

			  		</div>
			  	</div>
			  	<div class="row">
			  		<div class="col-md-6" style="border-style: solid;
		  border-width: 1px 1px 1px 1px; width: 50%; height: 50px;">อาการ<br><?= $value->TR_Symptom ?></div>
			  		<div class="col-md-6" style="border-style: solid;
		  border-width: 1px 1px 1px 1px; width: 50%; height: 50px;">การรักษา<br><?= $value->TR_Treatment ?></div>
			  	</div>
			  	<div class="row">
			  		<div class="col-md-2">แพทย์<br>&nbsp;&nbsp;<?= $value->Nurse_N_ID ?></div>
			  		<div class="col-md-6">ยารักษา<br>
			  			<?php $value2 = $hDEm[$index++] ?>
			  				<?php foreach ($value2 as $drug){?>
			  					<?php echo $drug['D_Name']; ?><br>
			  				<?php } ?> 

			  		</div>
			  		<div class="col-md-2">จำนวน<br>
			  			
			  				<?php foreach ($value2 as $drug){?>
			  					<?php echo $drug['D_Amount']; ?><br>
			  				<?php } ?> 

			  		</div>
			  		<div class="col-md-2">สถานะ<br><?= $value->TR_Status ?></div>
			  	</div>
			</div>
		</div>
	<?php } ?>
</div>

<?php ActiveForm::end(); ?>