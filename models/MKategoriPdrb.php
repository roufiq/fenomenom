<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_kategori_pdrb".
 *
 * @property integer $id_kategori
 * @property integer $id_pdrb
 * @property string $kategori_pdrb
 * @property string $kode_kategori
 */
class MKategoriPdrb extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_kategori_pdrb';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pdrb'], 'required'],
            [['id_pdrb'], 'integer'],
            [['kategori_pdrb'], 'string', 'max' => 255],
            [['kode_kategori'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kategori' => 'Id Kategori',
            'id_pdrb' => 'Jenis PDRB',
            'kategori_pdrb' => 'Uraian',
            'kode_kategori' => 'Kode Kategori',
        ];
    }

    /**
     * @inheritdoc
     * @return MKategoriPdrbQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MKategoriPdrbQuery(get_called_class());
    }
}
