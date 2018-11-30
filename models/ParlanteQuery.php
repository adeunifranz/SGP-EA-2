<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Parlante]].
 *
 * @see Parlante
 */
class ParlanteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Parlante[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Parlante|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
