<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ExpurgoMaterial;

/**
 * ExpurgoMaterialSearch represents the model behind the search form of `app\models\ExpurgoMaterial`.
 */
class ExpurgoMaterialSearch extends ExpurgoMaterial
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expurgo_id', 'material_id', 'carga_id', 'id', 'quantidade'], 'integer'],
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
        $query = ExpurgoMaterial::find();

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
            'expurgo_id' => $this->expurgo_id,
            'material_id' => $this->material_id,
            'carga_id' => $this->carga_id,
            'id' => $this->id,
            'quantidade' => $this->quantidade,
        ]);

        return $dataProvider;
    }
}
