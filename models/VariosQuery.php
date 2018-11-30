<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Varios]].
 *
 * @see Varios
 */
class VariosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Varios[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Varios|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
