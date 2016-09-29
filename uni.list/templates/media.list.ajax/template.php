<? foreach ( $arResult['ITEMS'] as $item): ?>
    <div class="media-list__item  item">
        <div class="box  box-tiny  item__main">
            <img src="<?=CFile::GetPath($item['PROPERTY_POSTER_VALUE'])?>" class="media-list__image"/>
        </div>
        <?/*<div class="box  box-tiny">
            <?=$item['PROPERTY_MESSAGE_VALUE']?>
        </div>*/?>
        <div class="box  box-tiny  flag  flag--flush">
            <img src="<?=CFile::GetPath($item['PROPERTY_USER_PICTURE_VALUE'])?>" 
                 alt="<?=$item['PROPERTY_USER_NAME_VALUE']?>" class="flag__img  media-list__user_image  u-mr" />
            <div class="flag__body  media-list__user_name">
                <?=$item['PROPERTY_USER_NAME_VALUE']?>
            </div>
        </div>
    </div>
<? endforeach; ?>
<?if ($arParams['PAGE'] == $arResult['PAGES'] ):?>
    <script>
        $('.js-media-list__btn').hide();
    </script> 
<?endif;?>