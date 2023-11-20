<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $line_number
 * @property string|null $date
 * @property int|null $price
 */
class Product extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%product}}';
    }

    public function rules()
    {
        return [
            [['line_number'], 'required'],
            [['line_number', 'price'], 'integer'],
            [['date'], 'safe'],
            [['line_number'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'line_number' => 'Line Number',
            'date' => 'Date',
            'price' => 'Price',
        ];
    }
}
