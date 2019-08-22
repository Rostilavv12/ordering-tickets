<?php

namespace common\models\base;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "seat".
 *
 * @property int $id
 * @property int $row
 * @property int $number
 */
class BaseSeat extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['row', 'number'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'row' => Yii::t('app', 'Row'),
            'number' => Yii::t('app', 'Number'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(BaseOrder::class, ['seat_id' => 'id']);
    }
}
