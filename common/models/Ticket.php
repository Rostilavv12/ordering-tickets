<?php

namespace common\models;

use common\models\base\BaseOrder;

/**
 * This is the model class realize logic of reserve/buy tickets
 */
class Ticket extends BaseOrder
{
    public static function getOccupiedPlaces($movie_id)
    {
        self::find()
            ->with('seats')
            ->where(['movie_id' => $movie_id])
            ->all();
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function reserve()
    {
        $this->setStatus(self::STATUS_RESERVE);
        $this->save(false);
    }

    public function buy()
    {
        $this->setStatus(self::STATUS_BUY);
        $this->save(false);
    }
}
