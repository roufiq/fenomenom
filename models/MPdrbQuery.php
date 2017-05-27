<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MPdrb]].
 *
 * @see MPdrb
 */
class MPdrbQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MPdrb[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MPdrb|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
