<?php

namespace app\models;

use app\models\Requisicao;
use yii\helpers\ArrayHelper;


class RequisicaoWithMaterial extends Requisicao
{
	/**
     * @var array IDs of the materiais
     */
	var $material_ids = [];
	
	/**
     * @return array the validation rules.
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            // each category_id must exist in category table (*1)
            ['material_ids', 'each', 'rule' => [
                    'exist', 'targetClass' => Material::className(), 'targetAttribute' => 'id'
                ]
            ],
        ]);
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'material_ids' => 'Materiais',
        ]);
    }

    /**
     * load the post's categories (*2)
     */
    public function loadMateriais()
    {
        $this->material_ids = [];
        if (!empty($this->id)) {
            $rows = RequisicaoMaterial::find()
                ->select(['material_id'])
                ->where(['requisicao_id' => $this->id])
                ->asArray()
                ->all();
            foreach($rows as $row) {
               $this->material_ids[] = $row['material_id'];
            }
        }
    }

    /**
     * save the post's categories (*3)
     */
    public function saveMateriais()
    {
        /* clear the categories of the post before saving */
        RequisicaoMaterial::deleteAll(['requisicao_id' => $this->id]);
        if (is_array($this->material_ids)) {
            foreach($this->material_ids as $material_id) {
                $pc = new RequisicaoMaterial();
                $pc->requisicao_id = $this->id;
                $pc->material_id = $material_id;
                $pc->save();
            }
        }
        /* Be careful, $this->materials_id can be empty */
    }
}

?>