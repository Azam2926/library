<?php

namespace frontend\widgets;

use common\models\Resource;
use frontend\assets\AppAsset;
use Yii;
use yii\base\Widget;
use yii\bootstrap5\Html;

class ResourceViewsAndDownloads extends Widget
{
    public Resource $resource;
    public string $showViewsAndDownloadsTemplate = <<<HTML
<div class="mt-3 mt-md-5">
    <div class="mb-2">
        <i class="fas fa-eye"></i> <span>[view_count]</span>
    </div>

    [download_count]
</div>
HTML;
    public string $buttonsTemplate = <<<HTML
        <div class="mt-3 mt-md-5 px-3 d-flex flex-column">
        [btn1]
        [btn2]
</div>
HTML;

    public function run()
    {
        $this->showViewsAndDownloads();
        if ($this->resource->open_access) {
            $this->showButtons();
            $this->view->registerJsFile('/js/rvad.js', ['depends' => AppAsset::class]);
        }
    }

    private function showViewsAndDownloads()
    {
        echo strtr($this->showViewsAndDownloadsTemplate, [
            '[view_count]' => $this->resource->resourceView ? $this->resource->resourceView->count : 0,
            '[download_count]' => $this->resource->type != Resource::TYPE_YOUTUBEVIDEO ? strtr('<div class="mb-2">
                        <i class="fas fa-arrow-circle-down"></i> <span>[download_count]</span>
                    </div>', ['[download_count]' => $this->resource->resourceDownload ? $this->resource->resourceDownload->count : 0])
                : ''
        ]);
    }

    private function showButtons()
    {
        echo match ($this->resource->type) {
            Resource::TYPE_YOUTUBEVIDEO => $this->renderWatchBtn(),
            Resource::TYPE_AUDIO => $this->renderBtns("Eshiting"),
            Resource::TYPE_TEXT => $this->renderBtns("Ko'ring"),
            default => 'default'
        };
    }

    private function renderWatchBtn(): string
    {
        return strtr($this->buttonsTemplate, [
            '[btn1]' => $this->viewBtn("Youtube da ko'rish"),
            '[btn2]' => ''
        ]);
    }

    private function renderBtns(string $text): string
    {
        return strtr($this->buttonsTemplate, [
            '[btn1]' => $this->viewBtn($text),
            '[btn2]' => $this->downloadBtn(),
        ]);
    }

    private function viewBtn(string $text): string
    {
        return Html::a($text, Yii::$app->request->url . '/view', [
            'class' => 'btn bg-secondary-color text-white mb-2 mb-md-3',
            'target' => '_blank'
        ]);
    }

    private function downloadBtn(): string
    {
        return Html::a("Yuklang", $this->resource->getUploadedFileUrlFromFrontend('file'), [
            'id' => 'download-btn',
            'class' => 'btn btn-outline-primary mb-2 mb-md-3',
            'download' => $this->resource->file,
            'data' => ['uuid' => $this->resource->uuid]
        ]);
    }

}