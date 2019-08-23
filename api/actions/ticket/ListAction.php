<?php

namespace api\actions\ticket;

use yii\rest\Action;

/**
 * Class SignIn
 * @package api\actions\ticket
 */
class ListAction extends Action
{
    /**
     * @param $movie_id
     * @return mixed
     */
    public function run()
    {
        return $this->modelClass::getOccupiedPlaces($movie_id);
    }
}