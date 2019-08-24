<?php

namespace api\actions\ticket;

use Yii;
use yii\rest\Action;
use yii\web\UnsupportedMediaTypeHttpException;

/**
 * Class SignIn
 * @package api\actions\ticket
 */
class BuyAction extends Action
{
    /**
     * @return mixed
     * 
     * @throws UnsupportedMediaTypeHttpException
     */
    public function run()
    {
        $movieId = Yii::$app->request->get('movie_id', null);

        if (is_null($movieId)) {
            throw new UnsupportedMediaTypeHttpException(Yii::t('app', 'You must chose movie'));
        }

        return ($this->modelClass)::buy($movieId);
    }
}