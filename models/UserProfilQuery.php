<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserProfil]].
 *
 * @see UserProfil
 */
class UserProfilQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UserProfil[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserProfil|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
