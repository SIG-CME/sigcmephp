<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expurgo".
 *
 * @property int $id
 * @property string|null $data
 * @property string|null $status
 *
 * @property ExpurgoMaterial[] $expurgoMaterials
 */
class Expurgo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expurgo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            #[['id'], 'required'],
            #[['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['data'], 'safe'],
            [['status'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'data' => Yii::t('app', 'Data'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[ExpurgoMaterials]].
     *
     * @return \yii\db\ActiveQuery|ExpurgoMaterialQuery
     */
    public function getExpurgoMaterials()
    {
        return $this->hasMany(ExpurgoMaterial::className(), ['expurgo_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ExpurgoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExpurgoQuery(get_called_class());
    }
}
