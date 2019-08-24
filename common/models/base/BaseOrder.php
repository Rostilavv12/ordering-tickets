<?php

namespace common\models\base;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $seat_id
 * @property int $movie_id
 * @property int $status
 *
 * @property BaseMovie $movie
 * @property BaseSeat $seat
 */
class BaseOrder extends ActiveRecord
{
    const STATUS_RESERVE = 0;
    const STATUS_BUY = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seat_id', 'movie_id', 'status'], 'required'],
            [['seat_id', 'movie_id', 'status'], 'integer'],
            [['seat_id', 'movie_id'], 'unique', 'skipOnError' => true,
                'targetAttribute' => ['seat_id', 'movie_id'],
                'message' => Yii::t('app', 'This ticket is already taken')],
            [['movie_id'], 'exist', 'skipOnError' => true,
                'targetClass' => BaseMovie::class, 'targetAttribute' => ['movie_id' => 'id']],
            [['seat_id'], 'exist', 'skipOnError' => true,
                'targetClass' => BaseSeat::class, 'targetAttribute' => ['seat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seat_id' => Yii::t('app', 'Seat ID'),
            'movie_id' => Yii::t('app', 'Movie ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovie()
    {
        return $this->hasOne(BaseMovie::class, ['id' => 'movie_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeat()
    {
        return $this->hasOne(BaseSeat::class, ['id' => 'seat_id']);
    }
}
