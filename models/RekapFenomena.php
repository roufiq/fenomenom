<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rekap_fenomena".
 *
 * @property integer $id
 * @property string $tahun
 * @property integer $triwulan
 * @property integer $id_pdrb
 * @property integer $id_kategori
 * @property integer $id_subkategori
 * @property integer $series
 * @property integer $pertumbuhan
 */
class RekapFenomena extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rekap_fenomena';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun'], 'safe'],
            [['triwulan', 'id_pdrb', 'id_kategori', 'id_subkategori', 'series', 'pertumbuhan'], 'integer'],
            [['pertumbuhan'],'number','min'=>0, 'max'=>2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'triwulan' => 'Triwulan',
            'id_pdrb' => 'Id Pdrb',
            'id_kategori' => 'Id Kategori',
            'id_subkategori' => 'Id Subkategori',
            'series' => 'Series',
            'pertumbuhan' => 'Pertumbuhan',
        ];
    }

    /**
     * @inheritdoc
     * @return RekapFenomenaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RekapFenomenaQuery(get_called_class());
    }

    public function generateLapanganUsaha($tahun,$triwulan)
    {
        $models=[];
        $model=[];
//        $id_kategori=[];
        $kategoris= MKategoriPdrb::find()
            ->select(['id_pdrb as id_pdrb','id_kategori as id_kategori'])
            ->where(['id_pdrb'=>1])
            ->asArray()->all();
//        $series= [1,2,3];

        foreach($kategoris as $key=>$kat)
        {
                $kategoris[$key]['id_subkategori']=null;

        }
        $this->array_insert($models,0,$kategoris);
        $subkategoris= MSubkategori::find()
            ->select(['id_pdrb as id_pdrb','id_kategori as id_kategori','id_sub as id_subkategori'])
            ->where(['id_pdrb'=>1])
            ->asArray()->all();
        $this->array_insert($models,0,$subkategoris);
        $duplicate = $models;
        for($i=1;$i<=3;$i++)
        {
            foreach($duplicate as $key=>$dup)
            {
                $duplicate[$key]['series']=$i;
//                Masukkan parameter tahun dan triwulan disini
                $duplicate[$key]['tahun']=$tahun;
                $duplicate[$key]['triwulan']=$triwulan;
            }
            $this->array_insert($model,0,$duplicate);
        }
        return $model;

    }
    public function generatePengeluaran($tahun, $triwulan)
    {
        $models=[];
//        $model=[];
//        $id_kategori=[];
        $kategoris= MKategoriPdrb::find()
            ->select(['id_pdrb as id_pdrb','id_kategori as id_kategori'])
            ->where(['id_pdrb'=>2])
            ->asArray()->all();
//        $series= [1,2,3];

        foreach($kategoris as $key=>$kat)
        {
            $kategoris[$key]['id_subkategori']=null;

        }
//        print_r($kategoris);
        $this->array_insert($models,0,$kategoris);
        $subkategoris= MSubkategori::find()
            ->select(['id_pdrb as id_pdrb','id_kategori as id_kategori','id_sub as id_subkategori'])
            ->where(['id_pdrb'=>2])
            ->asArray()->all();
        $this->array_insert($models,0,$subkategoris);
//        $duplicate = $models;
//        for($i=1;$i<=3;$i++)
//        {
            foreach($models as $key=>$dup)
            {
//                $model[$key]['series']=$i;
//                Masukkan parameter tahun dan triwulan disini
                $models[$key]['tahun']=$tahun;
                $models[$key]['triwulan']=$triwulan;
            }
//        print_r($models);
//            $this->array_insert($model,0,$duplicate);
//        }
        return $models;

    }

    /**
     * @param array      $array
     * @param int|string $position
     * @param mixed      $insert
     */
    public function array_insert(&$array, $position, $insert)
    {
        if (is_int($position)) {
            array_splice($array, $position, 0, $insert);
        } else {
            $pos   = array_search($position, array_keys($array));
            $array = array_merge(
                array_slice($array, 0, $pos),
                $insert,
                array_slice($array, $pos)
            );
        }
    }



}
