<div class="media-list  js-media-list">
<?=$arParams['~HEADER']?>
<? foreach ( $arResult['ITEMS'] as $item): ?>
    <div class="media-list__item  js-media-list__item">
        <div class="box  box-tiny  item__main">
            <img src="<?=CFile::GetPath($item['PROPERTY_POSTER_VALUE'])?>" class="media-list__image"/>
        </div>
        <?/*<div class="box  box-tiny">
            <?=$item['PROPERTY_MESSAGE_VALUE']?>
        </div>*/?>
        <div class="box  box-tiny">
            <div class="flag  flag--flush">
                <img src="<?=CFile::GetPath($item['PROPERTY_USER_PICTURE_VALUE'])?>" 
                     alt="<?=$item['PROPERTY_USER_NAME_VALUE']?>" class="flag__img  media-list__user_image  u-mr" />
                <div class="flag__body  media-list__user_name">
                    <?=$item['PROPERTY_USER_NAME_VALUE']?>
                </div>
            </div>
        </div>
    </div>
<? endforeach; ?>
    <div class="media-list__gutter"></div>
</div>
<?if ($arResult['PAGES'] > 1):?>
<div class="block  block--flush  block--center u-mb+  js-media-list__item  media-list__btn">
    <a href="#" class="comments-show-all-items  comments-margin  [ btn  btn--transparent ]  js-media-list__btn " >давай еще</a>
</div>
<?endif;?>