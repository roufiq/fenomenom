<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MSubkategori;

/**
 * MSubkategoriSearch represents the model behind the search form about `app\models\MSubkategori`.
 */
class MSubkategoriSearch extends MSubkategori
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sub', 'id_pdrb', 'id_kategori'], 'integer'],
            [['nama_sub'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = MSubkategori::find();

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
            'id_sub' => $this->id_sub,
            'id_pdrb' => $this->id_pdrb,
            'id_kategori' => $this->id_kategori,
        ]);

        $query->andFilterWhere(['like', 'nama_sub', $this->nama_sub]);

        return $dataProvider;
    }
}
