<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Monitor]].
 *
 * @see Monitor
 */
class MonitorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Monitor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Monitor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
