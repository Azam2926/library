<?php

namespace common\querys;

use common\models\Resource;
use common\models\Type;
use yii\db\ActiveQuery;

class ResourceQuery extends ActiveQuery
{
    const ELECTRON_RESOURCES_NAME = 'Elektron kitob';
    const AUDIO_RESOURCES_NAME = 'Audio kitob';
    const VIDEO_RESOURCES_NAME = 'Video darslik';

    public function all($db = null): array
    {
        return parent::all($db);
    }

    public function one($db = null): array|Resource|null
    {
        return parent::one($db);
    }

    public function news(int $limit): ResourceQuery
    {
        return $this->with('subject')->with('types')->orderBy(['created_at' => SORT_DESC])->limit($limit);
    }

    public function uuid(string $uuid): ResourceQuery
    {
        return $this->andWhere(['uuid' => $uuid]);
    }

    public function newElectrons(int $limit): ResourceQuery
    {
        return $this->andWhere(['type_id' => $this->getElectronsId()])->limit($limit);
    }

    public function newAudios(int $limit): ResourceQuery
    {
        return $this->andWhere(['type_id' => $this->getAudiosId()])->limit($limit);
    }

    public function newVideos(int $limit): ResourceQuery
    {
        return $this->andWhere(['type_id' => $this->getVideosId()])->limit($limit);
    }

    protected function getElectronsId(): ?int
    {
        return Type::findOne(['name' => self::ELECTRON_RESOURCES_NAME])?->id;
    }

    private function getAudiosId(): ?int
    {
        return Type::findOne(['name' => self::AUDIO_RESOURCES_NAME])?->id;
    }

    private function getVideosId(): ?int
    {
        return Type::findOne(['name' => self::VIDEO_RESOURCES_NAME])?->id;

    }

    public function active(): ResourceQuery
    {
        return $this->where(['status' => Resource::STATUS_ACTIVE]);
    }

    public function findById($id): ResourceQuery
    {
        return $this->andWhere(['id' => $id]);
    }
}
