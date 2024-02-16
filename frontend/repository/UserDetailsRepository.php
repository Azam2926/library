<?php

namespace frontend\repository;

use common\models\Reviews;
use common\models\UserDetails;
use yii\db\ActiveRecord;

class UserDetailsRepository
{
    /**
     * @return UserDetails|ActiveRecord
     */

    public function getByUser(): UserDetails|ActiveRecord
    {
        return UserDetails::find()->findByUserId()->one();
    }

}