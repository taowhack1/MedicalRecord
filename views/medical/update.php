<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\Treatmentrecord;
use yii\helpers\ArrayHelper;
use app\models\Drug;
use kartik\select2\Select2;
use kartik\touchspin\TouchSpin;
use kartik\datetime\DateTimePicker;
use app\assets\HideRelativeAndEmployeeAsset;

HideRelativeAndEmployeeAsset::register($this);

?>

<div class="record-update">
    <h1><?= Html::encode($this->title) ?></h1>
</div>

<?php $form = ActiveForm::begin(['id' => 'Create-form']);
?>
<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3"></div>
<div class="col-xs-9 col-md-9 col-lg-9 col-sm-9 panel panel-body panel-default">
	<div style="background-color: #b3e6ff; border-radius: 5px; height: 5%;">
		<div style=""><h2><b>&nbsp;&nbsp;แก้ไขบันทึกการรักษา</b></h2></div>
	</div>
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-xs-2">
				<?= Html::activeHiddenInput($model, 'TR_ID') ?>
				<?= Html::activeHiddenInput($hD, 'TreatmentRecord_TR_ID') ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-xs-2">
				<?= Html::activeHiddenInput($model, 'Nurse_N_ID') ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-xs-4">
				<?= Html::activeHiddenInput($model, 'Employee_Em_ID') ?>
			</div>
		</div>
	  	<div class="row">
			<div class="col-lg-6 col-xs-6">
			<?= $form->field($model, 'TR_Symptom')->textarea(['rows' => '3','maxlength' => true])
		    	->label('อาการ',['class'=>'label-class'])?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-xs-6">
			<?= $form->field($model, 'TR_Treatment')->textarea(['rows' => '3','maxlength' => true])
			->label('การรักษา',['class'=>'label-class']) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-xs-3">
				<?= $form->field($hD, 'Drug_D_ID',['options'=>['class'=>'label-class']])
				->widget(Select2::classname(), [
			        'data' => ArrayHelper::map(Drug::find()->all(), 'D_ID', function ($drug) {
			                    return $drug->D_Name;
			                }),
			        'size' => Select2::MEDIUM,
			        'language' => 'th',
			        'options' => ['placeholder' => '--Select Drug--'],
			        'pluginOptions' => [
			            'allowClear' => true
			        ],
			    ]);
     			?>
			</div>
			<div class="col-lg-2  col-md-2 col-xs-2">
				<?php $form->field($hD, 'D_Amount')->widget(TouchSpin::classname(), [
				    'options'=>['placeholder'=>'Enter rating 1 to 5...'],
				    'pluginOptions' => [
				        'verticalbuttons' => true,
				        'verticalupclass' => 'glyphicon glyphicon-plus',
				        'verticaldownclass' => 'glyphicon glyphicon-minus',
				    ]
				]);
				?>
				<?= $form->field($hD, 'D_Amount')->textInput(['maxlength' => true])
				->label('จำนวน',['class'=>'label-class']) ?>
			</div>
			<div class="col-lg-7 col-md-7 col-xs-7"></div>
		</div>
		<div class="row" >
			<h4>&nbsp;&nbsp;&nbsp;<B>สถานะ</B></h4>
			<div style="padding-left: 5%">
				<div class="col-lg-1 col-md-1 col-xs-2">
				<?= $form->field($model, 'TR_Status')->radio(['id'=>'rb_normal','label' => 'ปกติ', 'value' => 0, 'uncheck' => null]) ?>
				</div>

				<div class="col-lg-1 col-md-1 col-xs-2">
				<?= $form->field($model, 'TR_Status')->radio(['id'=>'rb_rest','label' => 'พัก', 'value' => 1, 'uncheck' => null]) ?>
				</div>

				<div class="col-lg-1 col-md-2 col-xs-2">
				<?= $form->field($model, 'TR_Status')->radio(['id'=>'rb_send','label' => 'ส่งต่อ', 'value' => 2, 'uncheck' => null]) ?>
				</div>
			</div>
		</div>

		<div class="extend" style="display: none;">
			<div class="row" style=''>
				<div class="col-lg-3 col-md-3 col-xs-3">
					<label>Start Date/Time</label>
					<?php 
					echo $form->field($model, 'TR_StartRest')->widget(DateTimePicker::classname(), [
						'name' => 'TR_StartRest',
					    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
					    'pluginOptions' => [
					        'format' => 'yyyy-mm-dd hh:ii:ss',
					        'showMeridian' => true,
					        'autoclose' => true,
					        'todayBtn' => true
					]]
						);
					?>
					
				</div>
				<div class="col-lg-1 col-md-1 col-xs-1">
				</div>
				<div class="col-lg-3 col-md-3 col-xs-3">
					<label>End Date/Time</label>
					<?php 
						echo $form->field($model, 'TR_EndRest')->widget(DateTimePicker::classname(), [
						'name' => 'TR_EndRest',
					    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
					    'pluginOptions' => [
					        'format' => 'yyyy-mm-dd hh:ii:ss',
					        'showMeridian' => true,
					        'autoclose' => true,
					        'todayBtn' => true
					]]
						);

					?>
				</div>
				<div class="col-lg-5 col-md-5 col-xs-5">
				</div>

			</div><br><br>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-xs-1">
		<?= Html::submitButton('บันทึก', ['class' => 'btn btn-save',
	        	'data' => [
	                'method' => 'post',
	            ]]) ?>  
	        </div>
	        <div class="col-lg-2 col-md-2 col-xs-1">
		<?= Html::a('ยกเลิก', ['/medical/view','Em_ID'=>$model->Employee_Em_ID], ['class' => 'btn btn-cancel']) ?> 
	        </div>
	        <div class="col-lg-8 col-md-8 col-xs-10">
	        </div>
	    </div>
	</div>
</div>
<?php ActiveForm::end(); ?>