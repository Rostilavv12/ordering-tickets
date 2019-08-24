<?php

namespace common\models;

use common\models\base\BaseOrder;
use Yii;
use yii\base\InvalidConfigException;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class realize logic of reserve/buy tickets
 */
class Ticket extends BaseOrder
{
    /**
     * get non-free places in hall
     *
     * @param $movie_id
     *
     * @return array
     */
    public static function getOccupiedPlaces($movieId)
    {
        return self::find()
            ->with('seat')
            ->where(['movie_id' => $movieId])
            ->asArray()
            ->all();
    }

    /**
     * @return array
     */
    public function fields()
    {
        return array_merge(
            parent::fields(),
            [
                'seat',
            ]
        );
    }

    /**
     * reserve tickets
     *
     * @param $movieId
     *
     * @return Ticket[]
     *
     * @throws InvalidConfigException
     * @throws ServerErrorHttpException
     */
    public static function reserve($movieId)
    {
        return self::createOrders(
            $movieId,
            self::STATUS_RESERVE
        );
    }

    /**
     * buy tickets
     *
     * @param $movieId
     *
     * @return Ticket[]
     *
     * @throws InvalidConfigException
     * @throws ServerErrorHttpException
     */
    public static function buy($movieId)
    {
        return self::createOrders(
            $movieId,
            self::STATUS_BUY
        );
    }

    /**
     * create orders for buy of reserve tickets
     *
     * @param $movieId
     * @param $status
     *
     * @return Ticket[]
     *
     * @throws InvalidConfigException
     * @throws ServerErrorHttpException
     */
    public static function createOrders($movieId, $status)
    {
        $errors = [];
        $tickets = self::createByParams(
            $movieId,
            $status,
            Yii::$app->request->getBodyParams()
        );

        foreach ($tickets as $ticket) {

            if (!$ticket->validate()) {
                $errors[] = $ticket->getErrors();
            }
        }

        if ($errors) {
            Yii::$app->response->setStatusCode(422, Yii::t('app', 'Validation error'));
            Yii::$app->response->data = ['errors' => $errors];

            Yii::$app->response->send();
        }

        $save = true;

        foreach ($tickets as $ticket) {
            $save &= $ticket->save(false);
        }

        if (!$save) {
            throw new ServerErrorHttpException();
        }

        Yii::$app->response->setStatusCode(201, Yii::t('app', 'Order complete'));

        return $tickets;
    }

    /**
     * create tickets by movie and seats ids
     *
     * @param $movieId
     * @param $status
     * @param array $seatIds
     *
     * @return self[]
     */
    public static function createByParams($movieId, $status, array $seatIds)
    {
        $tickets = [];

        foreach ($seatIds as $seatId) {
            $tickets[] = new self([
                'movie_id' => $movieId,
                'seat_id' => $seatId,
                'status' => $status,
            ]);
        }

        return $tickets;
    }
}
