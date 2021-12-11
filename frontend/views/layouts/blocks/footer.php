<?php

use yii\bootstrap5\Html;

?>
<footer class="footer bg-primary-color text-white mt-auto py-3 fs-6">
    <div class="container">
       <div class="row justify-content-around">
           <div class="col-md-6">
               <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
               <p style="color: white !important;" class="float-right"><?= Yii::powered() ?></p>
           </div>
           <div class="col-md-6">
               <h2>Bog'lanish</h2>
               <div class="d-flex align-self-center flex-column mt-2 mt-lg-0 flex-wrap">
                   <a href="mailto:eldor@tiiame.uz" class="g-color-gray-dark-v2 g-text-underline--none--hover">
                       <div class="g-me-25 my-1 d-flex">
                           <div class="me-4">
                               <div class="g-line-height-1_2">Email: eldor@tiiame.uz</div>
                           </div>
                       </div>
                   </a>
                   <a href="tel:+998901752102" class="g-color-gray-dark-v2 g-text-underline--none--hover">
                       <div class="my-1 d-flex">
                           <div class="me-4">
                               <div class="g-line-height-1_2">Tel: +99890 175-21-02</div>
                           </div>
                       </div>
                   </a>
               </div>
           </div>
       </div>
    </div>
</footer>