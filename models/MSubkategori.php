<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_subkategori".
 *
 * @property integer $id_sub
 * @property integer $id_pdrb
 * @property integer $id_kategori
 * @property string $nama_sub
 */
class MSubkategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_subkategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pdrb', 'id_kategori'], 'integer'],
            [['nama_sub'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sub' => 'Kode Sub',
            'id_pdrb' => 'Jenis PDRB',
            'id_kategori' => 'Jenis Kategori',
            'nama_sub' => 'Nama Sub',
        ];
    }

    /**
     * @inheritdoc
     * @return MSubkategoriQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MSubkategoriQuery(get_called_class());
    }
}
