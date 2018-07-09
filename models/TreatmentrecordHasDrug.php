<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "treatmentrecord_has_drug".
 *
 * @property string $TreatmentRecord_TR_ID เลขที่บันทึก
 * @property string $Drug_D_ID รหัสยา
 * @property int $D_Amount จำนวน
 *
 * @property Drug $drugD
 * @property Treatmentrecord $treatmentRecordTR
 */
class TreatmentrecordHasDrug extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'treatmentrecord_has_drug';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TreatmentRecord_TR_ID', 'Drug_D_ID'], 'required'],
            [['D_Amount'], 'integer'],
            [['TreatmentRecord_TR_ID', 'Drug_D_ID'], 'string', 'max' => 10],
            [['TreatmentRecord_TR_ID', 'Drug_D_ID'], 'unique', 'targetAttribute' => ['TreatmentRecord_TR_ID', 'Drug_D_ID']],
            //[['Drug_D_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Drug::className(), 'targetAttribute' => ['Drug_D_ID' => 'D_ID']],
            //[['TreatmentRecord_TR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Treatmentrecord::className(), 'targetAttribute' => ['TreatmentRecord_TR_ID' => 'TR_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TreatmentRecord_TR_ID' => 'เลขที่บันทึก',
            'Drug_D_ID' => 'ยาที่ใช้',
            'D_Amount' => 'จำนวน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrugD()
    {
        return $this->hasOne(Drug::className(), ['D_ID' => 'Drug_D_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatmentRecordTR()
    {
        return $this->hasOne(Treatmentrecord::className(), ['TR_ID' => 'TreatmentRecord_TR_ID']);
    }
}
