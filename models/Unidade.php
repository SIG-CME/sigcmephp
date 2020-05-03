<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unidade".
 *
 * @property int $id
 * @property string $descricao
 */
class Unidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descricao' => Yii::t('app', 'Unidade'),
        ];
    }
}
