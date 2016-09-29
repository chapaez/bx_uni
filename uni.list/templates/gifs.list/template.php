<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="projects left_column">
    <div class="b-gifs">
        <!-- Slider -->
        <div id="gifs-slider" class="carousel slide" data-ride="carousel">

            <? if ($arResult['SLIDER_NUM'] > 1): ?>
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <? for ($i = 0; $i < $arResult['SLIDER_NUM']; $i++): ?>
                        <li data-target="#gifs-slider"
                            data-slide-to="<?= $i ?>"
                            class="<?= $i == 0 ? 'active' : '' ?>"></li>
                    <? endfor; ?>
                </ol>
            <? endif; ?>

            <!-- Wrapper for slides -->
            <div class="carousel-inner shadow" role="listbox">
                <? foreach ($arResult["ITEMS"] as $key => $item):
                    $url = $item['DETAIL_PAGE_URL'];
                    ?>
                    <div class="item <?= $key == 0 ? 'active' : '' ?>">
                        <div class="item-image">
                            <a href="<?= $url ?>">
                                <img
                                    src="<?= $item['PREVIEW_PICTURE_SRC'] ?>"
                                    alt="">
                            </a>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>

            <? if ($arResult['SLIDER_NUM'] > 1): ?>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#gifs-slider"
                   role="button"
                   data-slide="prev"></a>
                <a class="right carousel-control" href="#gifs-slider"
                   role="button" data-slide="next"></a>
            <? endif; ?>

        </div>
        <!-- END Slider END -->

        <!-- Filter block -->
        <div class="b-gifs-filter">
            <header class="bcf-header">
                <div class="gifs-filter-all">
                    <a <?= empty($arResult['FILTER']) ? 'class="active"' : '' ?> href="/entertainment/gifs/">Все гифки</a>
                </div>
                <div class="gifs-filter-genre  <?= !empty($arResult['FILTER']) ? 'hidden' : '' ?>">Выбрать жанр</div>
                <!-- Filters tag list -->
                <ul class="list-unstyled bct-list <?= !empty($arResult['FILTER']) ? '' : 'hidden' ?>">
                    <? foreach ($arResult['GENRES'] as $code => $name): ?>
                        <li><span><?= $name ?><i></i></span></li>
                    <? endforeach; ?>
                </ul>
                <!-- END Filter tags list END -->
            </header>

            <ul class="list-unstyled bcf-list">
                <? foreach ($arResult['GENRES'] as $code => $name): ?>
                    <li>
                        <a href="<?= $_SERVER['SHORT_TRUE_URL'] . "?filter=" . $code ?>"
                           data-code="<?= $code ?>" <?= ($arResult['FILTER'] == $code) ? 'class="active"' : ''?>><?= $name ?></a>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
        <!-- END Filter block END -->

        <?
        if (count($arResult["ITEMS"]) > 0):
        ?>

        <div class="b-gifs-list-wrap">
            <div id="ctclove_preloader"></div>

            <div class="b-gifs-list">

                <? foreach ($arResult["ITEMS"] as $key => $item):
//                    $url = InitFunctions::getProjectUrl($item['ID']);
                    $url = $item['DETAIL_PAGE_URL'];
                    ?>
                    <div class="bcl-item">
                        <div class="bcl-item-image shadow">
                            <a href="<?= $url ?>">
                                <img
                                    src="<?=  $item['PREVIEW_PICTURE_SRC'] ?>"
                                    alt="">
                            </a>
                        </div>
                    </div>
                <? endforeach; ?>
                <?= $arResult["NAV_STRING"] ?>
            </div>

        </div>


    </div>

    <? else: ?>

        <div class="text-center  yellow_text"><h4>К сожалению, сейчас
                недоступны гифки этого жанра.<br>Попробуй зайти позднее.</h4>
        </div>

    <? endif; ?>
</div>