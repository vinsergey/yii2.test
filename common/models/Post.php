<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Post
 * @package common\models
 * @property int $id
 * @property string $author
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $content
 * @property string $image
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */

class Post extends ActiveRecord
{
    const STATUS_ON = 1;
    const STATUS_OFF = 0;
    /**
     * @return string
     */

    public static function tableName()
    {
        return '{{%posts}}';
    }

    public function rules()
    {
        return [
            [['author','title', 'slug', 'description', 'content', 'image'], 'string'],
            [['author','title', 'content'], 'required'],
            [['author','title', 'description', 'content', 'image'], 'trim'],
            ['status', 'boolean'],
            ['status', 'default', 'value' => self::STATUS_ON],
            ['status', 'in', 'range' => [self::STATUS_ON, self::STATUS_OFF]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
            ],
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }
}