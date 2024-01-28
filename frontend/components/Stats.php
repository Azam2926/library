<?php

namespace frontend\components;

use common\models\Resource;
use yii\base\BaseObject;

class Stats extends BaseObject
{
    public ?int $resources;

    public function getStats(): static
    {
        $this->resources = Resource::find()->count();
        return $this;
    }
}