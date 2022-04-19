<?php

namespace frontend\models;

use common\models\Resource;
use common\models\Subject;
use common\models\Type;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * @property array $languageList
 * @property array $accessList
 */
class ResourceFilter extends Model
{
    const PAGE_SIZE = 16;
    public string $title_publisher = '';

    public mixed $subjects = [];
    public mixed $types = [];
    public mixed $languages = [];
    public mixed $access = [];

    public array $subjectList = [];
    public array $typeList = [];

    public function rules(): array
    {
        return [
            ['subjects', 'in', 'range' => array_keys($this->getSubjectList()), 'allowArray' => true],
            ['types', 'in', 'range' => array_keys($this->getTypeList()), 'allowArray' => true],
            ['languages', 'in', 'range' => array_keys($this->languageList), 'allowArray' => true],
            ['access', 'in', 'range' => array_keys($this->accessList), 'allowArray' => true],
            ['title_publisher', 'string', 'max' => 255]
        ];

    }

    #[ArrayShape(['subjects' => "string", 'types' => "string", 'languages' => "string", 'access' => "string"])]
    public function attributeLabels(): array
    {
        return [
            'subjects' => "Fan yo'nalishlar",
            'types' => 'Turlar',
            'languages' => 'Tillar',
            'access' => 'Ruxsat',
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Resource::find()->with(['types']);

        if (Yii::$app->request->get('sort') == 'popularity' || Yii::$app->request->get('sort') == '-popularity')
            $query->joinWith('resourceView rv');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => self::PAGE_SIZE,
            ],
        ]);



        $dataProvider->setSort([
            'attributes' => [
                'title',
                'date',
                'popularity' => [
                    'asc' => ['rv.count' => SORT_ASC],
                    'desc' => ['rv.count' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Ommabopligi'
                ]
            ]
        ]);
        $this->load($params);

        if (!$this->validate())
            return $dataProvider;

        $query->andFilterWhere(['language' => $this->languages])
            ->andFilterWhere(['open_access' => $this->access])
            ->andFilterWhere(['type_id' => $this->types])
            ->andFilterWhere(['subject_id' => $this->subjects])
            ->andFilterWhere([
                'or',
                ['like', 'publisher', $this->title_publisher],
                ['like', 'title', $this->title_publisher]
            ]);

        return $dataProvider;
    }

    #[Pure] #[ArrayShape([Resource::LANG_UZ => "string", Resource::LANG_RU => "string", Resource::LANG_EN => "string"])]
    public function getLanguageList(): array
    {
        return Resource::getLanguageList();
    }

    public function getAccessList(): array
    {
        return ArrayHelper::merge(['' => 'Hammasi'], Resource::getAccessList());
    }

    public function getTypeList(): array
    {
        if (!$this->typeList)
            $this->typeList = Type::getList();

        return $this->typeList;
    }

    public function getSubjectList(): array
    {
        if (!$this->subjectList)
            $this->subjectList = Subject::getList();

        return $this->subjectList;
    }
}
