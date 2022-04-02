<?php

namespace common\models;

use common\querys\ResourceDownloadsQuery;
use common\querys\ResourceQuery;
use common\querys\ResourceViewsQuery;
use common\querys\SubjectQuery;
use common\querys\TypeQuery;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\bootstrap5\Html;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\AfterSaveEvent;
use yii\helpers\FileHelper;
use yii\helpers\StringHelper;
use yiidreamteam\upload\FileUploadBehavior;

/**
 * This is the model class for table "resource".
 *
 * @property int $id
 * @property string $uuid
 * @property int $subject_id
 * @property int|null $type_id
 * @property string $title
 * @property string|null $description
 * @property string|null $publisher
 * @property string|null $date
 * @property string|null $file
 * @property string|null $thumbnail
 * @property int|null $language
 * @property int|null $type
 * @property int|null $open_access
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ResourceDownloads $resourceDownload
 * @property ResourceViews $resourceView
 * @property Subject $subject
 * @property Type $types
 * @property string $format
 * @property string $size
 * @property string $extension
 * @method getUploadedFileUrl(string $string)
 * @method getImageFileUrl(string $string)
 * @method getThumbFileUrl(string $string)
 */
class Resource extends ActiveRecord
{
    const TRUNCATE_TEXT_NUMBER = 40;

    const NON_OPEN_ACCESS = 0;
    const OPEN_ACCESS = 1;

    const TYPE_TEXT = 0;
    const TYPE_AUDIO = 1;
    const TYPE_YOUTUBEVIDEO = 2;

    const LANG_UZ = 0;
    const LANG_RU = 1;
    const LANG_EN = 2;

    public int $popularity = 0;
    public ?string $youtubelink = '';

    #[ArrayShape([self::OPEN_ACCESS => "string", self::NON_OPEN_ACCESS => "string"])]
    public static function getAccessList(): array
    {
        return [
            self::OPEN_ACCESS => 'Ruxsat',
            self::NON_OPEN_ACCESS => 'Ruxsat emas',
        ];
    }

    #[ArrayShape([self::LANG_UZ => "string", self::LANG_RU => "string", self::LANG_EN => "string"])]
    public static function getLanguageList(): array
    {
        return [
            self::LANG_UZ => 'O\'zbekcha',
            self::LANG_RU => 'Ruscha',
            self::LANG_EN => 'Inglizcha',
        ];
    }

    #[ArrayShape([self::TYPE_TEXT => "string", self::TYPE_AUDIO => "string", self::TYPE_YOUTUBEVIDEO => "string"])]
    public static function getTypeList(): array
    {
        return [
            self::TYPE_TEXT => 'Text',
            self::TYPE_AUDIO => 'Audio',
            self::TYPE_YOUTUBEVIDEO => 'Youtube video'
        ];
    }

    #[ArrayShape([0 => "string", 'file_uploader' => "string[]"])]
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            'file_uploader' => [
                'class' => FileUploadBehavior::class,
                'attribute' => 'file',
                'filePath' => '@webroot/uploads/[[model]]/[[pk]]/[[filename]].[[extension]]',
                'fileUrl' => '/uploads/[[model]]/[[pk]]/[[filename]].[[extension]]',
            ],
            [
                'class' => '\yiidreamteam\upload\ImageUploadBehavior',
                'attribute' => 'thumbnail',
                'filePath' => '@webroot/uploads/[[model]]/thumbs/[[pk]]/[[filename]].[[extension]]',
                'fileUrl' => '/uploads/[[model]]/thumbs/[[pk]]/[[filename]].[[extension]]',
            ],

        ];
    }

    public static function tableName(): string
    {
        return 'resource';
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->on(self::EVENT_AFTER_INSERT, function (AfterSaveEvent $event) {
            $model = new ResourceViews();
            $model->resource_id = $event->sender->id;
            $model->count = 0;
            $model->save();
        });

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function rules(): array
    {
        return [
            [['subject_id', 'title'], 'required'],
            [['subject_id', 'type_id', 'language', 'type', 'open_access', 'created_at', 'updated_at'], 'integer'],
            [['description', 'youtubelink'], 'string'],
            [['uuid'], 'string', 'max' => 36],
            [['title', 'publisher', 'date'], 'string', 'max' => 255],
            [['uuid'], 'unique'],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['subject_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::class, 'targetAttribute' => ['type_id' => 'id']],
            ['file', 'file'],
//            ['thumbnail', 'file', 'extensions' => 'jpeg, gif, jpg, png'],
            ['thumbnail', 'file'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'uuid' => 'Uuid',
            'subject_id' => "Fan yo'nalishlari",
            'type_id' => 'Turlari',
            'title' => 'Sarlavha',
            'description' => 'Matn',
            'publisher' => 'Publisher',
            'date' => 'Nashr qilingan sana',
            'language' => 'Til',
            'type' => 'Type',
            'thumbnail' => 'Thumbnail',
            'file' => 'File',
            'open_access' => 'Ruxsat',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',

            'format' => 'Format',
            'size' => 'Hajmi'
        ];
    }

    public function getResourceDownload(): ActiveQuery|ResourceDownloadsQuery
    {
        return $this->hasOne(ResourceDownloads::class, ['resource_id' => 'id']);
    }

    public function getResourceView(): ActiveQuery|ResourceViewsQuery
    {
        return $this->hasOne(ResourceViews::class, ['resource_id' => 'id']);
    }

    public function getSubject(): SubjectQuery|ActiveQuery
    {
        return $this->hasOne(Subject::class, ['id' => 'subject_id']);
    }

    public function getTypes(): TypeQuery|ActiveQuery
    {
        return $this->hasOne(Type::class, ['id' => 'type_id']);
    }

    public static function find(): ResourceQuery
    {
        return new ResourceQuery(get_called_class());
    }

    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            $uuid = Uuid::uuid4();
            $this->uuid = $uuid->toString();
        }

        // ...custom code here...
        return true;
    }

    public function afterFind()
    {
        if ($this->type == self::TYPE_YOUTUBEVIDEO)
            $this->youtubelink = $this->file;
    }

    public function videoUpload()
    {
        $this->detachBehavior('file_uploader');
        $this->file = $this->youtubelink;
    }

    public function removeFile()
    {
        try {
            FileHelper::removeDirectory(Yii::getAlias('@webroot/uploads/resource/' . $this->id));
        } catch (Exception $exception) {
            dd($exception);
        }
    }

    public function showFile(): ?string
    {
        if (!$this->file)
            return '';
        return match ($this->type) {
            Resource::TYPE_YOUTUBEVIDEO => Html::a('View Video', $this->file, ['_target' => 'blank']),
            Resource::TYPE_AUDIO, Resource::TYPE_TEXT => Html::a('View File', $this->getUploadedFileUrl('file'), ['_target' => 'blank']),
            default => 'default'
        };
    }

    public function showThumbnail(): ?string

    {
        if (!$this->thumbnail)
            return '';
        return Html::img($this->getUploadedFileUrl('thumbnail'), ['alt' => 'Thumbnail', 'width' => 400, 'height' => 'auto']);
    }

    public function saveAll(): bool
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($this->save())
                $transaction->commit();
        } catch (Exception $exception) {
            $transaction->rollBack();
            return false;
        }

        return true;

    }

    public function beforeDelete()
    {
        $this->deleteResourceViews();
        $this->deleteResourceDownloads();
        return parent::beforeDelete();
    }

    public function afterDelete()
    {
        $this->removeFile();
    }

    public function isTypeAudio(): bool
    {
        if ($this->type == self::TYPE_AUDIO)
            return true;

        return false;
    }

    public function showType(): string
    {
        return match ($this->type) {
            Resource::TYPE_YOUTUBEVIDEO => "<p><i class='fab fa-youtube me-1'></i>Video</p>",
            Resource::TYPE_AUDIO => "<p><i class='far fa-headphones me-1'></i>Audio</p>",
            Resource::TYPE_TEXT => "<p><i class='far fa-book me-1'></i>" . $this->types->name . "</p>",
            default => 'default'
        };
    }

    public function getUploadedFileUrlFromFrontend(string $file_name): string
    {
        if (!$this->getUploadedFileUrl($file_name))
            return match ($this->type) {
                Resource::TYPE_YOUTUBEVIDEO => "/fallbacks/video.jpg",
                Resource::TYPE_AUDIO => "/fallbacks/audio.jpg",
                Resource::TYPE_TEXT => "/fallbacks/text.jpg",
                default => 'default'
            };

        return Yii::$app->params['curl'] . $this->getUploadedFileUrl($file_name);
    }

    public function showAccess(): string
    {
        return $this->open_access
            ? '<span class="card-header bg-secondary-color p-0 px-1 text-center text-white">RUXSAT</span>'
            : '<span class="card-header p-0 px-1 text-center">RUXSAT EMAS</span>';
    }

    public function getYearFromDate(): string
    {
        if (!$this->date)
            return '';

        return StringHelper::explode($this->date, '-')[2];
    }

    #[Pure]
    public function showLanguage(): string
    {
        return self::getLanguageList()[$this->language];
    }

    public function getFormat(): ?string
    {
        if ($this->type == self::TYPE_YOUTUBEVIDEO)
            return "Youtube video";

        if (!$this->file)
            return '';

        return FileHelper::getMimeType($this->getFilePath('file'));
    }

    public function getSize(): ?string
    {
        if ($this->type == self::TYPE_YOUTUBEVIDEO)
            return "Youtube video";

        if (!$this->file)
            return '';

        return Yii::$app->formatter->asShortSize(filesize($this->getFilePath('file')));
    }

    public function getExtension(): ?string
    {
        if ($this->type == self::TYPE_YOUTUBEVIDEO)
            return "Youtube video";

        if (!$this->file)
            return '';

        return pathinfo($this->getFilePath('file'), PATHINFO_EXTENSION);
    }

    protected function getFilePath($file): bool|string
    {
        return Yii::getAlias('@backend/web' . $this->getUploadedFileUrl($file));
    }

    public function updateViewCount(): void
    {
        if (!$model = ResourceViews::findOne(['resource_id' => $this->id]))
            $model = new ResourceViews();
        $this->updateCount($model);
    }

    public function updateDownloadCount()
    {
        if (!$model = ResourceDownloads::findOne(['resource_id' => $this->id]))
            $model = new ResourceDownloads();
        $this->updateCount($model);
    }

    private function updateCount(ResourceViews|ResourceDownloads $model): void
    {
        $model->resource_id = $this->id;

        if (!$model->count)
            $model->count = 1;
        else
            $model->count = $model->count + 1;

        if (!$model->save())
            throw new \yii\db\Exception('something wrong!!');
    }

    private function deleteResourceViews()
    {
        ResourceViews::deleteAll(['resource_id' => $this->id]);
    }

    private function deleteResourceDownloads()
    {
        ResourceDownloads::deleteAll(['resource_id' => $this->id]);
    }
}

