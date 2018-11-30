<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Teclado]].
 *
 * @see Teclado
 */
class TecladoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Teclado[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Teclado|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
