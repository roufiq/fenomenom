<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MSubkategori]].
 *
 * @see MSubkategori
 */
class MSubkategoriQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MSubkategori[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MSubkategori|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
