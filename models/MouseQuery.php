<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Mouse]].
 *
 * @see Mouse
 */
class MouseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Mouse[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Mouse|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
