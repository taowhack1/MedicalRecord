<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drug".
 *
 * @property string $D_ID รหัสยา
 * @property string $D_Name ชื่อยา
 * @property string $D_Prop
 * @property string $D_Type ประเภทของยา
 *
 * @property TreatmentrecordHasDrug[] $treatmentrecordHasDrugs
 * @property Treatmentrecord[] $treatmentRecordTRs
 */
class Drug extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drug';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['D_ID'], 'required'],
            [['D_ID', 'D_Type'], 'string', 'max' => 10],
            [['D_Name'], 'string', 'max' => 30],
            [['D_Prop'], 'string', 'max' => 150],
            [['D_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'D_ID' => 'รหัสยา',
            'D_Name' => 'ชื่อยา',
            'D_Prop' => 'D Prop',
            'D_Type' => 'ประเภทของยา',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatmentrecordHasDrugs()
    {
        return $this->hasMany(TreatmentrecordHasDrug::className(), ['Drug_D_ID' => 'D_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatmentRecordTRs()
    {
        return $this->hasMany(Treatmentrecord::className(), ['TR_ID' => 'TreatmentRecord_TR_ID'])->viaTable('treatmentrecord_has_drug', ['Drug_D_ID' => 'D_ID']);
    }
}
