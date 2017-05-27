<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MTahun]].
 *
 * @see MTahun
 */
class MTahunQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MTahun[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MTahun|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
