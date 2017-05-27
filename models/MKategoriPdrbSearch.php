<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MKategoriPdrb;

/**
 * MKategoriPdrbSearch represents the model behind the search form about `app\models\MKategoriPdrb`.
 */
class MKategoriPdrbSearch extends MKategoriPdrb
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kategori', 'id_pdrb'], 'integer'],
            [['kategori_pdrb', 'kode_kategori'], 'safe'],
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
        $query = MKategoriPdrb::find();

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
            'id_kategori' => $this->id_kategori,
            'id_pdrb' => $this->id_pdrb,
        ]);

        $query->andFilterWhere(['like', 'kategori_pdrb', $this->kategori_pdrb]);
        $query->andFilterWhere(['like', 'kategori_pdrb', $this->kode_kategori]);

        return $dataProvider;
    }
}
