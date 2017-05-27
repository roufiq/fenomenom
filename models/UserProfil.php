<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_profil".
 *
 * @property string $nip
 * @property string $nama
 * @property string $jabatan
 * @property string $username
 * @property string $photo
 */
class UserProfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nip'], 'required'],
            [['nip', 'username'], 'string', 'max' => 50],
            [['nama', 'jabatan', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nip' => 'NIP',
            'nama' => 'Nama',
            'jabatan' => 'Jabatan',
            'username' => 'Username',
            'photo' => 'Avatar',
        ];
    }

    /**
     * @inheritdoc
     * @return UserProfilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserProfilQuery(get_called_class());
    }


}
