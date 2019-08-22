<?php

namespace common\models\base;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "movie".
 *
 * @property int $id
 * @property int $film_id
 * @property int $time
 *
 * @property BaseFilm $film
 * @property BaseOrder[] $orders
 */
class BaseMovie extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['film_id', 'time'], 'required'],
            [['film_id', 'time'], 'integer'],
            [['film_id'], 'exist', 'skipOnError' => true,
                'targetClass' => BaseFilm::class, 'targetAttribute' => ['film_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'film_id' => Yii::t('app', 'Film ID'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilm()
    {
        return $this->hasOne(BaseFilm::class, ['id' => 'film_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(BaseOrder::class, ['movie_id' => 'id']);
    }
}
