<?php

namespace common\models;

use common\querys\SubjectQuery;
use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Subject".
 *
 * @property int $id
 * @property string $name
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    #[ArrayShape(['id' => "string", 'name' => "string"])]
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public static function find(): SubjectQuery
    {
        return new SubjectQuery(get_called_class());
    }

    public static function getList(): array
    {
        return self::find()->select('name')->indexBy('id')->column();
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            Resource::deleteAll(['subject_id' => $this->id]);
            return true;
        }

        return parent::beforeDelete();
    }
}
