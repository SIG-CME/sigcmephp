<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carga".
 *
 * @property int $id
 * @property string|null $data
 * @property int $categoriaid
 *
 * @property Categoria $categoria
 * @property RequisicaoMaterial[] $requisicaoMaterials
 */
class Carga extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carga';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoriaid'], 'required'],
            [['id', 'categoriaid'], 'default', 'value' => null],
            [['id', 'categoriaid'], 'integer'],
            [['data'], 'safe'],
            [['id'], 'unique'],
            [['categoriaid'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['categoriaid' => 'id']],
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
            'categoriaid' => Yii::t('app', 'Categoriaid'),
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['id' => 'categoriaid']);
    }

    /**
     * Gets query for [[RequisicaoMaterials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequisicaoMaterials()
    {
        return $this->hasMany(RequisicaoMaterial::class, ['carga_id' => 'id']);
    }
}
