<?php

namespace common\models;

use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\bootstrap5\Html;
use yii\db\ActiveQuery;
use yiidreamteam\upload\ImageUploadBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "resource_images".
 *
 * @property int $id
 * @property int $resource_id
 * @property string|null $path
 * @property string|null $name
 *
 * @property Resource $resource
 * @method getUploadedFileUrl(string $string)
 * @method getImageFileUrl(string $string)
 */
class ResourceImages extends ActiveRecord
{

    const FILE_ATTRIBUTE_NAME = 'path';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'resource_images';
    }

    /**
     * {@inheritdoc}
     * @return ResourceImagesQuery the active query used by this AR class.
     */
    public static function find(): ResourceImagesQuery
    {
        return new ResourceImagesQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
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
    #[ArrayShape(['id' => "string", 'resource_id' => "string", 'path' => "string"])] public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'resource_id' => 'Resource ID',
            'path' => 'Path',
        ];
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => self::FILE_ATTRIBUTE_NAME,
                'filePath' => '@webroot/uploads/[[model]]/[[attribute_resource_id]]/[[filename]].[[extension]]',
                'fileUrl' => '/uploads/[[model]]/[[attribute_resource_id]]/[[filename]].[[extension]]',
            ]
        ];
    }

    public function getResource(): ActiveQuery|ResourceImagesQuery
    {
        return $this->hasOne(Resource::class, ['id' => 'resource_id']);
    }

    public function getUploadedUrl(): string
    {
        return $this->getImageFileUrl(self::FILE_ATTRIBUTE_NAME);
    }

    public function getUploadedFileUrlFromFrontend(): string
    {
        return Yii::$app->params['curl'] . $this->getUploadedUrl();
    }
    public function showImages(): ?string
    {
        if (!$this->path)
            return '';

        return Html::img(Yii::$app->params['curl'].$this->getUploadedFileUrl(self::FILE_ATTRIBUTE_NAME), ['alt' => 'Thumbnail', 'width' => 400, 'height' => 'auto']);
    }

}
