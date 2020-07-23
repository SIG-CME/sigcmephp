<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requisicao".
 *
 * @property int $id
 * @property string|null $data
 * @property int $unidadeid
 * @property string|null $tipo
 * @property string|null $status
 *
 * @property Unidade $unidade
 * @property RequisicaoMaterial[] $requisicaoMaterials
 */
class Requisicao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requisicao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unidadeid'], 'required'],
            [['unidadeid'], 'default', 'value' => null],
            [['id', 'unidadeid'], 'integer'],
            [['data'], 'safe'],
            [['tipo', 'status'], 'string', 'max' => 50],
            [['id'], 'unique'],
            [['unidadeid'], 'exist', 'skipOnError' => true, 'targetClass' => Unidade::class, 'targetAttribute' => ['unidadeid' => 'id']],
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
            'unidadeid' => Yii::t('app', 'Unidade Funcional'),
            'tipo' => Yii::t('app', 'Tipo'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Unidade]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUnidade()
    {
        return $this->hasOne(Unidade::class, ['id' => 'unidadeid']);
    }

    /**
     * Gets query for [[RequisicaoMaterials]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getRequisicaoMaterials()
    {
        return $this->hasMany(RequisicaoMaterial::class, ['requisicao_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RequisicaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequisicaoQuery(get_called_class());
    }
}
