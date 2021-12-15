<?php

namespace frontend\components;

use common\models\Resource;
use common\models\ResourceDownloads;
use common\models\ResourceViews;
use yii\base\BaseObject;

class Stats extends BaseObject
{
    public ?int $resources;
    public ?int $resource_views;
    public ?int $resource_downloads;

    public function getStats(): static
    {
        $this->resources = Resource::find()->count();
        $this->resource_views = ResourceViews::find()->select('sum(count) as all_counts')->one()->all_counts ?? 0;
        $this->resource_downloads = ResourceDownloads::find()->select('sum(count) as all_counts')->one()->all_counts ?? 0;

        return $this;
    }
}