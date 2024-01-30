<?php

namespace backend\form;


use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class ResourceForm extends Model
{
    public $id;
    public $subject_id;
    public $type_id;
    public $title;
    public $description;
    public $publisher;
    public $date;
    public $language;
    public $open_access;
    public $price;
    public $count;
    public $status;
    /**
     * @var UploadedFile[]
     */
    public $images;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['images', 'file'],
            [['id', 'subject_id', 'type_id', 'count', 'status'], 'integer'],
            ['price', 'double'],
            [['title', 'description', ''], 'string'],
            ['type', 'required'],
        ];
    }
}