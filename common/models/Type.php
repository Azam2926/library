<?php

namespace common\models;

use common\querys\ResourceQuery;
use common\querys\TypeQuery;
use JetBrains\PhpStorm\ArrayShape;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Resource[] $resources
 */
class Type extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'type';
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

    public function getResources(): ActiveQuery|ResourceQuery
    {
        return $this->hasMany(Resource::class, ['type_id' => 'id']);
    }

    public static function find(): TypeQuery
    {
        return new TypeQuery(get_called_class());
    }

    public static function getList(): array
    {
        return self::find()->select('name')->indexBy('id')->column();
    }
}
