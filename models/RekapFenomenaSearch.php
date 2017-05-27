<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RekapFenomena;
use yii\db\Expression;

/**
 * RekapFenomenaSearch represents the model behind the search form about `app\models\RekapFenomena`.
 */
class RekapFenomenaSearch extends RekapFenomena
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'triwulan', 'id_pdrb', 'id_kategori', 'id_subkategori', 'series', 'pertumbuhan'], 'integer'],
            [['tahun'], 'safe'],
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
        $getParameter=Yii::$app->request->getQueryParam('RekapFenomenaSearch');

        $query = RekapFenomena::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 72],
//            'sort'=> ['defaultOrder' => [''tahun=>SORT_ASC]]
            'sort'=>[
//
                'defaultOrder'=>[
                    'tahun'=>SORT_ASC,
                    'triwulan'=>SORT_ASC,
                    'id_kategori'=>SORT_ASC,
                    'id_subkategori'=>SORT_ASC,
                    'series'=>SORT_ASC,

                ]
            ],
        ]);
//        Cari Parameter

        if(isset($getParameter['id_pdrb']))
        {
            $getJenispdrb= $getParameter['id_pdrb'];
            if($getJenispdrb==1)
                $dataProvider->pagination->pageSize=72;
            else if($getJenispdrb==2)
                $dataProvider->pagination->pageSize=23;
//            print_r($dataProvider);
        }
        if(isset($getParameter['tahun']))
            $getTahun= $getParameter['tahun'];
        if(isset($getParameter['triwulan']))
            $getTriwulan = $getParameter['triwulan'];

//        print_r($params);



        if (!($this->load($params) && $this->validate())) {

            return $dataProvider;
        }

//        $this->load($params);
//
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }

//        $dataProvider->query->joinWith('tahun');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'tahun' => $this->tahun,
//            'triwulan' => $this->triwulan,
            'id_pdrb' => $this->id_pdrb,
//            'id_kategori' => $this->id_kategori,
//            'id_subkategori' => $this->id_subkategori,
//            'series' => $this->series,
//            'pertumbuhan' => $this->pertumbuhan,
        ]);
        $query->andFilterWhere(['like', 'rekap_fenomena.tahun', $this->tahun]);
        $query->andFilterWhere(['like', 'rekap_fenomena.triwulan', $this->triwulan]);
        $query->andFilterWhere(['like', 'rekap_fenomena.id_pdrb', $this->id_pdrb]);



        return $dataProvider;
    }

    public function getRekapLapus($id_pdrb, $tahun, $triwulan)
    {
        $query= RekapFenomena::find()->indexBy('id')
            ->where(['tahun'=>$tahun])
            ->andWhere(['triwulan'=>$triwulan])
            ->andWhere(['id_pdrb'=>$id_pdrb])
            ->orderBy(['id_kategori'=>SORT_ASC, 'id_subkategori'=>SORT_ASC, 'series'=>SORT_ASC]);

        $dataProvider=new ActiveDataProvider([
            'query'=>$query,
            'pagination' => ['pageSize' =>72],
        ]);
        return $dataProvider;
    }
}
