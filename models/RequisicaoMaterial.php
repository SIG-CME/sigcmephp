<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requisicao_material".
 *
 * @property int $requisicao_id
 * @property int $material_id
 *
 * @property Material $material
 * @property Requisicao $requisicao
 */
class RequisicaoMaterial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requisicao_material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['requisicao_id', 'material_id'], 'required'],
            [['requisicao_id', 'material_id'], 'default', 'value' => null],
            [['requisicao_id', 'material_id'], 'integer'],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::className(), 'targetAttribute' => ['material_id' => 'id']],
            [['requisicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requisicao::className(), 'targetAttribute' => ['requisicao_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'requisicao_id' => Yii::t('app', 'Requisicao ID'),
            'material_id' => Yii::t('app', 'Material ID'),
        ];
    }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id' => 'material_id']);
    }

    /**
     * Gets query for [[Requisicao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequisicao()
    {
        return $this->hasOne(Requisicao::className(), ['id' => 'requisicao_id']);
    }
}
