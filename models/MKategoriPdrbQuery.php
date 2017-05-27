<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MKategoriPdrb]].
 *
 * @see MKategoriPdrb
 */
class MKategoriPdrbQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MKategoriPdrb[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MKategoriPdrb|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
