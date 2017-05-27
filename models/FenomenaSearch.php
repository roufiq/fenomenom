<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fenomena;

/**
 * FenomenaSearch represents the model behind the search form about `app\models\Fenomena`.
 */
class FenomenaSearch extends Fenomena
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_fenomena', 'author', 'is_verified', 'triwulan', 'id_pdrb', 'id_kategori_pdrb', 'id_subkategori'], 'integer'],
            [['date_created', 'judul', 'summary', 'berkas', 'tag', 'date_verified', 'judul_rev', 'summary_rev', 'tahun'], 'safe'],
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
        $query='';
        if(Yii::$app->user->identity->username=='admin')
        {
            $query = Fenomena::find()->where(['is_verified'=>null]);
        }
        else
        {
            $query = Fenomena::find()->where(['author'=>Yii::$app->user->getId()])->andWhere(['is_verified'=>null]);
        }

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
            'id_fenomena' => $this->id_fenomena,
            'date_created' => $this->date_created,
            'author' => $this->author,
            'is_verified' => $this->is_verified,
            'date_verified' => $this->date_verified,
            'triwulan' => $this->triwulan,
            'tahun' => $this->tahun,
            'id_pdrb' => $this->id_pdrb,
            'id_kategori_pdrb' => $this->id_kategori_pdrb,
            'id_subkategori' => $this->id_subkategori,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'berkas', $this->berkas])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'judul_rev', $this->judul_rev])
            ->andFilterWhere(['like', 'summary_rev', $this->summary_rev]);

        return $dataProvider;
    }

    public function verifikasi($params)
    {
        $query='';
        if(Yii::$app->user->identity->username=='admin')
        {
            $query = Fenomena::find()->where(
                ['is_verified'=>1]);
        }
        else
        {
            $query = Fenomena::find()->where(['author'=>Yii::$app->user->getId()])->andWhere(['is_verified'=>1]);
        }

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
            'id_fenomena' => $this->id_fenomena,
            'date_created' => $this->date_created,
            'author' => $this->author,
            'is_verified' => $this->is_verified,
            'date_verified' => $this->date_verified,
            'triwulan' => $this->triwulan,
            'tahun' => $this->tahun,
            'id_pdrb' => $this->id_pdrb,
            'id_kategori_pdrb' => $this->id_kategori_pdrb,
            'id_subkategori' => $this->id_subkategori,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'berkas', $this->berkas])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'judul_rev', $this->judul_rev])
            ->andFilterWhere(['like', 'summary_rev', $this->summary_rev]);

        return $dataProvider;
    }
}
