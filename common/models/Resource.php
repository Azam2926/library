<?php

namespace common\models;

use common\querys\ResourceQuery;
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
 * @property float|null $price
 * @property string|null $discount_type
 * @property float|null $discount_value
 * @property int|null $count
 * @property int|null $status
 *
 * @property ResourceImages[] $images
 * @property Subject $subject
 * @property Type $types
 * @method getUploadedFileUrl(string $string)
 * @method getImageFileUrl(string $string)
 * @method getThumbFileUrl(string $string)
 */
class Resource extends ActiveRecord
{
    const TRUNCATE_TEXT_NUMBER = 35;

    const NON_OPEN_ACCESS = 0;
    const OPEN_ACCESS = 1;

    const LANG_UZ = 1;
    const LANG_RU = 2;
    const LANG_EN = 3;

    const STATUS_ACTIVE = 1;
    const STATUS_IN_ACTIVE = 2;

    public int $popularity = 0;

    #[ArrayShape([self::STATUS_ACTIVE => "string", self::STATUS_IN_ACTIVE => "string"])]
    public static function getStatus(): array
    {
        return [
            self::STATUS_ACTIVE => 'Faol',
            self::STATUS_IN_ACTIVE => 'Faol emas',
        ];
    }


    #[ArrayShape([self::OPEN_ACCESS => "string", self::NON_OPEN_ACCESS => "string"])]
    public static function getAccessList(): array
    {
        return [
            self::OPEN_ACCESS => 'Ruxsat',
            self::NON_OPEN_ACCESS => 'Ruxsat emas',
        ];
    }

    public static function tableName(): string
    {
        return 'resource';
    }

    public static function find(): ResourceQuery
    {
        return new ResourceQuery(get_called_class());
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

    public function rules(): array
    {
        return [
            [['subject_id', 'title'], 'required'],
            [['discount_value', 'price'], 'safe'],
            [['subject_id', 'type_id', 'language', 'type', 'open_access', 'created_at', 'updated_at', 'count', 'status'], 'integer'],
            [['description'], 'string'],
            [['uuid'], 'string', 'max' => 36],
            [['title', 'publisher', 'date', 'discount_type'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'price' => 'Price',
            'discount_value' => 'Discount Value',
            'discount_type' => 'Discount Type',
            'count' => 'Count',
            'format' => 'Format',
            'size' => 'Hajmi'
        ];
    }

    public function getImages(): ResourceImagesQuery|ActiveQuery
    {
        return $this->hasMany(ResourceImages::class, ['resource_id' => 'id']);
    }

    public function getSubject(): SubjectQuery|ActiveQuery
    {
        return $this->hasOne(Subject::class, ['id' => 'subject_id']);
    }

    public function getTypes(): TypeQuery|ActiveQuery
    {
        return $this->hasOne(Type::class, ['id' => 'type_id']);
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
    public function showThumbnail(): ?string

    {
        if (!$this->thumbnail)
            return '';
        $res = '';

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

    public function afterDelete()
    {
        $this->removeFile();
        $this->removeThumb();
    }

    public function removeFile()
    {
        try {
            FileHelper::removeDirectory(Yii::getAlias('@webroot/uploads/resource/' . $this->id));
        } catch (Exception $exception) {
            dd($exception);
        }
    }

    public function removeThumb()
    {
        try {
            FileHelper::removeDirectory(Yii::getAlias('@webroot/uploads/resource/thumbs/' . $this->id));
        } catch (Exception $exception) {
            dd($exception);
        }
    }

    public function getUploadedFileUrlFromFrontend(string $file_name): string
    {
        if (!$this->getUploadedFileUrl($file_name))
            return match ($this->type) {
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

    public function inStock(): string
    {
        return $this->count == 0 ?? '<div class="sale-flash badge bg-secondary p-2">Out of Stock</div>';
    }

    public function getYearFromDate(): string
    {
        if (!$this->date)
            return '';

        return StringHelper::explode($this->date, '-')[0];
    }

    #[Pure]
    public function showLanguage(): string
    {
        return self::getLanguageList()[$this->language];
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


    #[Pure] public function getLanguage(): string
    {
        if ($this->language == null)
            return '';

        return self::getLanguageList()[$this->language];
    }

    protected function getFilePath($file): bool|string
    {
        return Yii::getAlias('@backend/web' . $this->getUploadedFileUrl($file));
    }
    public function getFirstTwoPublisher(): string
    {
        $publishers = StringHelper::explode($this->publisher, ',');
        if (count($publishers) > 2)
            return $publishers[0] . ', ' . $publishers[1];

        return $this->publisher;
    }

    public function getFirstImageUrl(): string
    {
        $imagesUrl = $this->getImagesUrl();
        if (!$imagesUrl)
            return '';

        return $imagesUrl[0];
    }

    public function getFirstImageUrlFront(): string
    {
        return Yii::$app->params['curl'] . $this->getFirstImageUrl();
    }

    public function getImagesUrl(): array
    {
        $res = [];
        foreach ($this->images as $image)
            $res[] = Yii::getAlias('/uploads/resourceImages/'.$this->id. '/' . $image->path);

        return $res;
    }
}

