<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property int $id
 * @property string|null $nome
 * @property int $categoriaid
 *
 * @property Categoria $categoria
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoriaid'], 'required'],
            [['categoriaid'], 'default', 'value' => null],
            [['categoriaid'], 'integer'],
            [['nome'], 'string', 'max' => 300],
            [['categoriaid'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoriaid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'categoriaid' => 'Categoria',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoriaid']);
    }
}
