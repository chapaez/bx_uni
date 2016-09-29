<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

$count = count($arResult["ITEMS"]);
if ($count > 0):
    $big_i = '';
    $thumb = '';
    $mobile = '';
    ?>
    <!-- Magnific Popup core JS file -->
    <? /*<script src="http://dimsemenov.com/plugins/magnific-popup/dist/jquery.magnific-popup.min.js?v=1.0.0"></script>*/
    ?>
    <!-- Magnific Popup core CSS file -->


<? foreach ($arResult["ITEMS"] as $key => $item) {
    $url = InitFunctions::getElementUrlById($item["ID"], 'photo_gallery');
    $thumb_image = (strlen($item["PREVIEW_PICTURE_SRC"]) > 0) ? $item["PREVIEW_PICTURE_SRC"] : $item["DETAIL_PICTURE_SRC"];
    $big_i .= '<div class="swiper-slide" data-name="' . $item["NAME"] . '" data-id="' . $item["ID"] . '" data-num="' . ($key + 1) . '" style="background-image:url(' . $item["DETAIL_PICTURE_SRC"] . ')"></div>';
    $thumb .= '<div class="swiper-slide" data-name="' . $item["NAME"] . '" data-id="' . $item["ID"] . '" data-num="' . ($key + 1) . '" style="background-image:url(' . $thumb_image . '); background-position: center top;"></div>';

    $mobile .=  '<div class="swiper-slide" data-name="' . $item["NAME"] . '"
                     data-num="' . ($key + 1) . '" data-id="'. $item["ID"] . '">
                    <img data-src="' . $item["DETAIL_PICTURE_SRC"] . '"
                         class="swiper-lazy">
                    <div
                        class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                </div>';
    
    // FOR SEO IN COMPONENT_EPILOG
    if ($arParams['ELEMENT_ID'] > 0 && $arParams['ELEMENT_ID'] == $item['ID']) 
        $arResult['DETAIL_ELEMENT'] = $item;

} ?>
<? endif; ?>
    <div class="modal fade" id="galleryModal">
        <div class="modal-dialog">
            <div class="modal-content violet_back" id="mtop">
                <div style="position: relative;height: 100%;">
                    <div class="modal-header">
                        <div class="">
                            <div class="photo-name"></div>
                            <div class="photo-num">Фотография <span
                                    id="pNum">1</span> из <span
                                    id="pCount"><?= $count ?></span></div>
                        </div>
                        <div class="right-block">
                            <span class="mdi mdi-fullscreen"></span>
                            <div class="">во весь экран</div>
                        </div>
                        <div class="modal-close-btn">
                            <span class="mdi mdi-close-circle"></span>
                        </div>
                    </div>
                    <div id="gallery_wrap" style="visibility: hidden;">
                        <div class="swiper-container gallery-top" id="gTop">
                            <div class="swiper-wrapper">
                                <?= $big_i ?>
                            </div>
                            <div
                                class="swiper-button-next swiper-button-white"></div>
                            <div
                                class="swiper-button-prev swiper-button-white"></div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <?= $thumb ?>
                            </div>
                            <div
                                class="swiper-button-next swiper-button-white"></div>
                            <div
                                class="swiper-button-prev swiper-button-white"></div>
                        </div>
                    </div>
                    <? $APPLICATION->IncludeFile("/includes/social_nocount.php"); ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<? /*мобилка*/ ?>
    <div
        class="hidden swiper-container swiper-container-horizontal gallery-mobile">
        <div class="swiper-wrapper">
           <?= $mobile ?>
        </div>
        <div class="right carousel-control"></div>
        <div class="left carousel-control"></div>
        <div class="name"><?= $arResult["ITEMS"][0]['NAME'] ?></div>
        <div class="count">Фотография <span>1</span> из <?= $count ?></div>
    </div>
    <div class="visible-xs gallery-mobile-social">
        <? $APPLICATION->IncludeFile("/includes/social_nocount.php"); ?>
    </div>
<? ?>