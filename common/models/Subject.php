<?php

namespace common\models;

use common\querys\SubjectQuery;
use JetBrains\PhpStorm\ArrayShape;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "Subject".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string|null $slug
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 */
class Subject extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    public function rules(): array
    {
        return [
//            [['parent_id'], 'required'],
            [['name'], 'required'],
            [['description', 'slug'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'integer'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    #[ArrayShape(['id' => "string", 'name' => "string", 'parent_id' => 'integer', 'slug' => 'string',
        'description' => 'string', 'updated_at' => 'integer', 'created_at' => 'integer'])]
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'description' => 'Description',
            'slug' => 'slug',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function find(): SubjectQuery
    {
        return new SubjectQuery(get_called_class());
    }

    public function getSubject(): ActiveQuery
    {
        return $this->hasOne(Subject::class, ['id' => 'parent_id']);
    }

    public static function getList(): array
    {
        return self::find()->select('name')->indexBy('id')->column();
    }

    public function beforeDelete(): bool
    {
        Resource::deleteAll(['subject_id' => $this->id]);
        return parent::beforeDelete();
    }
}
