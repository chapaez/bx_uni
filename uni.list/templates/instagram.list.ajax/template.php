<? foreach ( $arResult['ITEMS'] as $item): ?>
    <div class="media-list__item  js-media-list__item">
        <?=$item['~PROPERTY_VIDEO_VALUE']?>
    </div>
<? endforeach; ?>
<?if ($arParams['PAGE'] == $arResult['PAGES'] ):?>
    <script>
        $('.js-media-list__btn').hide();
    </script> 
<?endif;?>