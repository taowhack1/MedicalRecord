<?php
use yii\helpers\Html;
use yii\jui\DatePicker;
use app\models\Treatmentrecord;
use yii\helpers\ArrayHelper;
use app\models\Drug;
use kartik\select2\Select2;
use kartik\touchspin\TouchSpin;
use kartik\datetime\DateTimePicker;
use app\assets\HideRelativeAndEmployeeAsset;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

HideRelativeAndEmployeeAsset::register($this);

$time = new \DateTime('now');
$tr_id = $time->format('Ymd').($count+1);
$tr->Employee_Em_ID = $key->Em_ID;
$tr->TR_ID = $tr_id;
$tr->TR_Date = $time->format('Y-m-d');
$tr->Nurse_N_ID = 'N0001';
$hDrug->TreatmentRecord_TR_ID = $tr->TR_ID;


?>



<?php $form = ActiveForm::begin(['id' => 'Employee-form'
]);

$this->title = $key->Em_ID;
$this->params['breadcrumbs'][] = ['label' => 'Search', 'url' => ['search']];
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['view', 'Em_ID' => $tr->Employee_Em_ID]];
$this->params['breadcrumbs'][] = 'AddRecord';
?>
<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3">
	<div class="w3-sidebar"> 
		  	<div class="photo">
		  		<?php echo Html::img('@web/assets/24be5741/employee.jpg') ?>
		  	</div>
		    <div class="col-xs-11" style="margin-left:2%">
		       <?= $form->field($key, 'Em_ID')->textInput() ?>
		    </div>
		    <div class="col-xs-11" style="margin-left:2%">
		       <?= $form->field($key, 'Em_fName')->textInput() ?>
		    </div>
		    <div class="col-xs-11" style="margin-left:2%">
		        <?= $form->field($key, 'Em_lName')->textInput() ?>
		    </div>
		    <div class="col-xs-11" style="margin-left:2%">
		       <?= $form->field($key, 'Em_Mobile')->textInput() ?>
		    </div>
		    <div class="col-xs-11" style="margin-left:2%">
		        <?= $form->field($key, 'Em_IDCard')->textInput() ?>
		    </div>
		    <div class="col-xs-11" style="margin-left:2%">
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
<?php ActiveForm::end(); ?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']);
?>
<div class="col-xs-9 col-md-9 col-lg-9 col-sm-9 panel panel-body panel-default">
	<div style="background-color: #b3e6ff; border-radius: 5px; height: 5%;">
		<div style=""><h2><b>&nbsp;&nbsp;บันทึกการรักษา</b></h2></div>
	</div>
	<br><br>
	<div class="container col-lg-12  col-md-12 col-xs-12">
		<div class="row">
			<div class="col-lg-2 col-xs-2">
				<?= Html::activeHiddenInput($tr, 'TR_ID') ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-xs-2">
				<?= Html::activeHiddenInput($tr, 'Nurse_N_ID') ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-xs-4">
				<?= Html::activeHiddenInput($tr, 'Employee_Em_ID') ?>
			</div>
		</div>
	  	<div class="row">
			<div class="col-lg-6 col-xs-6">
			<?= $form->field($tr, 'TR_Symptom')->textarea(['rows' => '3','maxlength' => true])
		    	->label('อาการ',['class'=>'label-class'])?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-xs-6">
			<?= $form->field($tr, 'TR_Treatment')->textarea(['rows' => '3','maxlength' => true])
			->label('การรักษา',['class'=>'label-class']) ?>
			</div>
		</div>
		<!--เริ่มส่วนยา-->

		<?php DynamicFormWidget::begin([
	        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
	        'widgetBody' => '.container-items', // required: css class selector
	        'widgetItem' => '.item', // required: css class
	        'limit' => 3, // the maximum times, an element can be cloned (default 999)
	        'min' => 1, // 0 or 1 (default 1)
	        'insertButton' => '.add-item', // css class
	        'deleteButton' => '.remove-item', // css class
	        'model' => $modelsDrug[0],
	        'formId' => 'dynamic-form',
	        'formFields' => [
	            'D_ID',
	            'D_Amount',
	        ],
    	]); ?>
	    	<div class="panel panel-default">
		    	<div class="panel-heading">
		            <i class="fa fa-envelope"></i> Drug
		            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Drug</button>
		            <div class="clearfix"></div>
		        </div>
		        <div class="panel-body container-items"><!-- widgetContainer -->
		        	<?php foreach ($modelsDrug as $index => $modelDrug): ?>
		                <div class="item panel panel-default"><!-- widgetBody -->
		                    <div class="panel-heading">
		                        <span class="panel-title-address">Drug: <?= ($index + 1) ?></span>
		                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
		                        <div class="clearfix"></div>
		                    </div>
		                    <div class="panel-body">
		                        <?php
		                            // necessary for update action.
		                            if (!$modelDrug->isNewRecord) {
		                                echo Html::activeHiddenInput($modelDrug, '[{$index}]TreatmentRecord_TR_ID');
		                            }
		                        ?>


		                        <div class="row">
		                        	<div class="col-sm-6">
		                        		    <?= $form->field($modelDrug, 'Drug_D_ID',['options'=>
		                        			['class'=>'label-class']])
											->widget(Select2::classname(), [
										        'data' => ArrayHelper::map(Drug::find()->all(), 'D_ID', function ($model) {
										                    return $model->D_Name;
										                }),
										        
										        'size' => Select2::MEDIUM,
										        'language' => 'th',
										        'options' => ['placeholder' => '--Select Drug--'],
										        'pluginOptions' => [
										            'allowClear' => true
										        ],	
										    ]
										);?>
		                        	</div> <!--close D_ID-->
		                        	<div class="col-sm-6">
		                        		<?= $form->field($modelDrug, 'D_Amount')->textInput(['maxlength' => true])
											->label('จำนวน',['class'=>'label-class']) 
		                        			->widget(TouchSpin::classname(), [
											    'pluginOptions' => [
											        'verticalbuttons' => true,
											        'verticalupclass' => 'glyphicon glyphicon-plus',
											        'verticaldownclass' => 'glyphicon glyphicon-minus',
											        
											    ]
											]
											);
										?>
		                        	</div> <!-- close D_Amount-->
		                       	</div> <!--row-->
		                    </div> <!--panel-body-->	
		                </div> <!--Panel-->

	        		<?php endforeach; ?>
	        	</div><!-- widgetContainer -->
	        </div><!-- Panel -->
    	<?php DynamicFormWidget::end(); ?>


		<!--ปิดส่วนเพิ่มยา-->
		<div class="row" >
			<h4>&nbsp;&nbsp;&nbsp;<B>สถานะ</B></h4>
			<div style="padding-left: 5%">
				<div class="col-lg-1 col-md-1 col-xs-2">
				<?= $form->field($tr, 'TR_Status')->radio(['id'=>'rb_normal','label' => 'ปกติ', 'value' => 0, 'uncheck' => null]) ?>
				</div>

				<div class="col-lg-1 col-md-1 col-xs-1">
				<?= $form->field($tr, 'TR_Status')->radio(['id'=>'rb_rest','label' => 'พัก', 'value' => 1, 'uncheck' => null]) ?>
				</div>

				<div class="col-lg-3 col-md-3 col-xs-3">
				<?= $form->field($tr, 'TR_Status')->radio(['id'=>'rb_send','label' => 'ส่งต่อ', 'value' => 2, 'uncheck' => null]) ?>
				</div>
			</div>
		</div>
		<div class="extend" style="display: none;">
			<div class="row" style='' >
				<div class="col-lg-3 col-md-3 col-xs-3">
					<label>Start Date/Time</label>
					<?php 
					echo $form->field($tr, 'TR_StartRest')->widget(DateTimePicker::classname(), [
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
						echo $form->field($tr, 'TR_EndRest')->widget(DateTimePicker::classname(), [
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
		<?= Html::a('ยกเลิก', ['/medical/view','Em_ID'=>$key->Em_ID], ['class' => 'btn btn-cancel']) ?> 
	        </div>
	        <div class="col-lg-8 col-md-8 col-xs-10">
	        </div>
	    </div>
	</div>
</div>
<br>
<?php ActiveForm::end(); ?>


