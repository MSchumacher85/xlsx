<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_data".
 *
 * @property int $id
 * @property int|null $file_id
 * @property int|null $line_number
 * @property string|null $date
 * @property int|null $price
 *
 * @property FileName $file
 */
class FileData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_id', 'line_number', 'price'], 'integer'],
            [['date'], 'safe'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => FileName::class, 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_id' => 'File ID',
            'line_number' => 'Line Number',
            'date' => 'Date',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(FileName::class, ['id' => 'file_id']);
    }
}
