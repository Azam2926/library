<?php

namespace common\helpers;


use common\models\enum\ResourceShowerEnum;
use common\models\Resource;
use common\models\ResourceShower;
use Yii;
use yii\helpers\ArrayHelper;

class ResourceShowerHelper
{

    public static function positionList()
    {
        return [
            ResourceShower::SLIDER=> Yii::t('yii', 'SLIDER'),
            ResourceShower::FEATURE => Yii::t('app', 'FEATURE'),
            ResourceShower::ARCHIVED => Yii::t('app', 'ARCHIVED'),
        ];
    }

    public static function positionName($position)
    {
        return ArrayHelper::getValue(self::positionList(), $position);
    }



}