<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RequisicaoMaterial;

/**
 * RequisicaoMaterialSearch represents the model behind the search form of `app\models\RequisicaoMaterial`.
 */
class RequisicaoMaterialSearch extends RequisicaoMaterial
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['requisicao_id', 'material_id', 'id', 'quantidade'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RequisicaoMaterial::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'requisicao_id' => $this->requisicao_id,
            'material_id' => $this->material_id,
            'id' => $this->id,
            'quantidade' => $this->quantidade,
        ]);

        return $dataProvider;
    }
}
