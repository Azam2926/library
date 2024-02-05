<?php

namespace common\helpers;


use common\models\ResourceShower;
use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\helpers\ArrayHelper;
use Exception;

class ResourceShowerHelper
{

    #[ArrayShape([ResourceShower::SLIDER => "string", ResourceShower::FEATURE => "string", ResourceShower::ARCHIVED => "string"])] public static function positionList(): array
    {
        return [
            ResourceShower::SLIDER=> Yii::t('yii', 'SLIDER'),
            ResourceShower::FEATURE => Yii::t('app', 'FEATURE'),
            ResourceShower::ARCHIVED => Yii::t('app', 'ARCHIVED'),
        ];
    }

    /**
     * @throws Exception
     */
    public static function positionName($position)
    {
        return ArrayHelper::getValue(self::positionList(), $position);
    }



}