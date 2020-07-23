<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Expurgo]].
 *
 * @see Expurgo
 */
class ExpurgoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Expurgo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Expurgo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
