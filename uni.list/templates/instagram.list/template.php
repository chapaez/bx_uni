<div class="media-list  js-media-list">
<?=$arParams['~HEADER']?>
<? foreach ( $arResult['ITEMS'] as $item): ?>
    <div class="media-list__item  js-media-list__item">
       <?=$item['~PROPERTY_VIDEO_VALUE']?>
    </div>
<? endforeach; ?>
    <div class="media-list__gutter"></div>
</div>
<?if ($arResult['PAGES'] > 1):?>
<div class="block  block--flush  block--center u-mb+  js-media-list__item  media-list__btn">
    <a href="#" class="comments-show-all-items  comments-margin  [ btn  btn--transparent ]  js-media-list__btn " >давай еще</a>
</div>
<?endif;?>
