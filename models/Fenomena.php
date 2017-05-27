<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "t_fenomena".
 *
 * @property integer $id_fenomena
 * @property string $date_created
 * @property integer $author
 * @property string $judul
 * @property string $summary
 * @property string $berkas
 * @property string $tag
 * @property integer $is_verified
 * @property string $date_verified
 * @property string $judul_rev
 * @property string $summary_rev
 * @property integer $triwulan
 * @property string $tahun
 * @property integer $id_pdrb
 * @property integer $id_kategori_pdrb
 * @property integer $id_subkategori
 */
class Fenomena extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_fenomena';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_created', 'date_verified', 'tahun'], 'safe'],
            [['author', 'is_verified', 'triwulan', 'id_pdrb', 'id_kategori_pdrb', 'id_subkategori'], 'integer'],
            [['summary', 'summary_rev'], 'string'],
            [['judul', 'tag', 'judul_rev'], 'string', 'max' => 255],
            [['berkas'],'file','extensions'=>['pdf','png','jpg','jpeg','doc','docx','xls','xlsx'],'maxSize'=>21000000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_fenomena' => 'Id Fenomena',
            'date_created' => 'Tanggal Buat',
            'author' => 'Penulis',
            'judul' => 'Judul',
            'summary' => 'Ringkasan',
            'berkas' => 'Berkas',
            'tag' => 'Tag',
            'is_verified' => 'Verifikasi?',
            'date_verified' => 'Tanggal Verifikasi',
            'judul_rev' => 'Judul',
            'summary_rev' => 'Ringkasan',
            'triwulan' => 'Triwulan',
            'tahun' => 'Tahun',
            'id_pdrb' => 'PDRB',
            'id_kategori_pdrb' => 'Kategori PDRB',
            'id_subkategori' => 'Subkategori',
        ];
    }

    /**
     * @inheritdoc
     * @return FenomenaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FenomenaQuery(get_called_class());
    }

    public function getBerkas()
    {
//        Yii::$app->params['uploadPath'] =  Yii::$app->getUrlManager()->baseUrl.'/uploads/';
        Yii::$app->params['uploadPath'] =  Yii::getAlias('@webroot').'/uploads/';
//        $path = Yii::$app->params['uploadPath'] .$this->berkas;
        return isset($this->berkas)? Yii::$app->params['uploadPath'].$this->berkas: null;
    }

    public function deleteBerkas() {
        $file = $this->getBerkas();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->berkas = null;
//        $this->filename = null;

        return true;
    }

    public function uploadBerkas()
    {
        $image = UploadedFile::getInstance($this,'berkas');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            $this->berkas=null;
            return false;
        }

        // store the source file name
        $this->berkas = $image->name;
        $tmp = explode(".", $image->name);
        $ext = end($tmp);

//        $ext = $image->name;

        // generate a unique file name
        $this->berkas = Yii::$app->security->generateRandomString().".{$ext}";

        // the uploaded image instance
        return $image;
    }


}
