<?php

namespace api\controllers;

use api\actions\ticket\BuyAction;
use api\actions\ticket\ListAction;
use api\actions\ticket\ReserveAction;
use yii\rest\ActiveController;

class TicketController extends ActiveController
{
    public $modelClass = 'common\models\Ticket';

    public function actions()
    {
        return [
            'list' => [
                'class' => ListAction::class,
                'modelClass' => $this->modelClass
            ],
            'reserve' => [
                'class' => ReserveAction::class,
                'modelClass' => $this->modelClass
            ],
            'buy' => [
                'class' => BuyAction::class,
                'modelClass' => $this->modelClass
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}
