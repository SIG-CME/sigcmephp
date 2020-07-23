<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requisicao_material".
 *
 * @property int $requisicao_id
 * @property int $material_id
 * @property int $id
 * @property int|null $quantidade
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
            [['quantidade', 'material_id'], 'required'],
            [['requisicao_id', 'material_id', 'quantidade'], 'default', 'value' => null],
            [['requisicao_id', 'material_id', 'quantidade'], 'integer'],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::class, 'targetAttribute' => ['material_id' => 'id']],
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
            'id' => Yii::t('app', 'ID'),
            'quantidade' => Yii::t('app', 'Quantidade'),
        ];
    }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::class, ['id' => 'material_id']);
    }

    /**
     * Gets query for [[Requisicao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequisicao()
    {
        return $this->hasOne(Requisicao::class, ['id' => 'requisicao_id']);
    }
}
