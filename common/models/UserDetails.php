<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use common\querys\UserDetailsQuery;

/**
 * This is the model class for table "user_details".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $phone
 * @property string|null $home_address
 * @property string|null $work_address
 * @property string|null $full_address
 * @property string|null $description
 * @property int|null $status
 *
 * @property User $user
 */
class UserDetails extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'user_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['home_address', 'work_address', 'full_address', 'description'], 'string'],
            [['firstname', 'lastname', 'phone'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'phone' => 'Phone',
            'home_address' => 'Home Address',
            'work_address' => 'Work Address',
            'full_address' => 'Full Address',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserDetailsQuery the active query used by this AR class.
     */
    public static function find(): UserDetailsQuery
    {
        return new UserDetailsQuery(get_called_class());
    }
}
