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
     * @param $movieId
     *
     * @return mixed
     */
    public function run($movieId)
    {
        return ($this->modelClass)::getOccupiedPlaces($movieId);
    }
}