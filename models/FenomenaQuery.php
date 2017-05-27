<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Fenomena]].
 *
 * @see Fenomena
 */
class FenomenaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Fenomena[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Fenomena|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
