<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_pdrb".
 *
 * @property integer $id_pdrb
 * @property string $uraian_pdrb
 */
class MPdrb extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_pdrb';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uraian_pdrb'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pdrb' => 'Id Pdrb',
            'uraian_pdrb' => 'Jenis PDRB',
        ];
    }

    /**
     * @inheritdoc
     * @return MPdrbQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MPdrbQuery(get_called_class());
    }
}
