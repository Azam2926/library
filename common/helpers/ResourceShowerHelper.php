<?php

namespace common\helpers;


use yii\helpers\ArrayHelper;

class ResourceShowerHelper
{
   public static $array = [

      1 => 'SLIDER',
      2 => 'FEATURE',
      3 => 'ARCHIVED'
   ];


   public static function getPosition($type){

       return self::$array[$type];
   }


}