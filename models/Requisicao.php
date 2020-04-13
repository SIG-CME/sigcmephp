<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requisicao".
 *
 * @property int $id
 * @property string|null $data
 * @property int $unidadeid
 *
 * @property Unidade $unidade
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
            [[ 'unidadeid'], 'required'],
            [['unidadeid'], 'default', 'value' => null],
            [['unidadeid'], 'integer'],
            [['data'], 'safe'],
            [['unidadeid'], 'exist', 'skipOnError' => true, 'targetClass' => Unidade::className(), 'targetAttribute' => ['unidadeid' => 'id']],
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
        ];
    }

    /**
     * Gets query for [[Unidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnidade()
    {
        return $this->hasOne(Unidade::className(), ['id' => 'unidadeid']);
    }
}
