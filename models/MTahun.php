<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_tahun".
 *
 * @property integer $id_tahun
 * @property string $tahun_data
 * @property integer $is_active
 */
class MTahun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_tahun';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun_data'], 'safe'],
            [['is_active'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tahun' => 'Id Tahun',
            'tahun_data' => 'Tahun Data',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @inheritdoc
     * @return MTahunQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MTahunQuery(get_called_class());
    }
}
