<div id="top-account" class="header-misc-icon px-3 dropdown">
    <a href="#" id="dropdownMenuLink" data-bs-toggle="dropdown"
       aria-expanded="false"><i class="bi-people"></i></a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <?php use yii\helpers\Html;

        if (Yii::$app->user->isGuest) {
            echo '<li><a class="dropdown-item" href="/site/login">Login</a></li>';
        } else {
            echo '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'm-0'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'dropdown-item']
                )
                . Html::endForm()
                . '</li>';
        } ?>
    </ul>
</div>