<?php

namespace common\models;

use Yii;
use yii\bootstrap5\Html;
use yii\db\ActiveQuery;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "resource_images".
 *
 * @property int $id
 * @property int $resource_id
 * @property string|null $path
 *
 * @property Resource $resource
 * @method getUploadedFileUrl(string $string)
 */
class ResourceImages extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resource_images';
    }

    /**
     * {@inheritdoc}
     * @return ResourceImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResourceImagesQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resource_id'], 'required'],
            [['resource_id'], 'integer'],
//            ['path', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 5, 'message' => 'Nimadir xato'],
            [['resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::class, 'targetAttribute' => ['resource_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resource_id' => 'Resource ID',
            'path' => 'Path',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'path',
                'filePath' => '@webroot/uploads/[[model]]/[[attribute_resource_id]]/[[filename]].[[extension]]',
                'fileUrl' => '/uploads/[[model]]/[[attribute_resource_id]]/[[filename]].[[extension]]',
            ]
        ];
    }

    public function getResource(): ActiveQuery|ResourceImagesQuery
    {
        return $this->hasOne(Resource::class, ['id' => 'resource_id']);
    }

    public function getUploadedFileUrlFromFrontend(): string
    {
        return Yii::$app->params['curl'] . $this->getUploadedFileUrl('path');
    }
    public function showImages(): ?string

    {
        if (!$this->path)
            return '';
        $res = '';

        return Html::img(Yii::$app->params['curl'].$this->getUploadedFileUrl('path'), ['alt' => 'Thumbnail', 'width' => 400, 'height' => 'auto']);
    }

}
