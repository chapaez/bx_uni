<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="projects left_column">
    <div class="b-cinema">
        <!-- Slider -->
        <div id="cinema-slider" class="carousel slide" data-ride="carousel">

            <? if ($arResult['SLIDER_NUM'] > 1): ?>
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <? for ($i = 0; $i < $arResult['SLIDER_NUM']; $i++): ?>
                        <li data-target="#cinema-slider"
                            data-slide-to="<?= $i ?>"
                            class="<?= $i == 0 ? 'active' : '' ?>"></li>
                    <? endfor; ?>
                </ol>
            <? endif; ?>

            <!-- Wrapper for slides -->
            <div class="carousel-inner shadow" role="listbox">
                <? foreach ($arResult["SLIDER"] as $key => $item):
                    $url = InitFunctions::getProjectUrl($item['ID']);
                    ?>
                    <div class="item <?= $key == 0 ? 'active' : '' ?>">
                        <div class="item-image">
                            <a href="<?= $url ?>">
                                <img
                                    src="<?= CFile::GetPath($item['BANNER_IN_SLIDER']['VALUE']) ?>"
                                    alt="">
                            </a>
                        </div>
                        <div class="item-info">
                            <div
                                class="item-info-title"><?= $item['NAME'] ?></div>
                            <div class="item-info-desc">
                                <span><?= implode(', ', $item['FILTER_GENRES']['NAMES']) ?>
                                    <i class="age-category"><?= $item['MIN_AGE']['VALUE'] ?></i>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>

            <? if ($arResult['SLIDER_NUM'] > 1): ?>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#cinema-slider"
                   role="button"
                   data-slide="prev"></a>
                <a class="right carousel-control" href="#cinema-slider"
                   role="button" data-slide="next"></a>
            <? endif; ?>

        </div>
        <!-- END Slider END -->

        <!-- Filter block -->
        <div class="b-cinema-filter">
            <header class="bcf-header">
                <div class="cinema-filter-all">
                    <a <?= empty($arResult['FILTER']) ? 'class="active"' : '' ?> href="/films/">Все фильмы</a>
                </div>
                <div class="cinema-filter-genre  <?= !empty($arResult['FILTER']) ? 'hidden' : '' ?>">Выбрать жанр</div>
                <!-- Filters tag list -->
                <ul class="list-unstyled bct-list <?= !empty($arResult['FILTER']) ? '' : 'hidden' ?>">
                    <? foreach ($arResult['GENRES'] as $code => $name): ?>
                        <? if ($arResult['FILTER'] == $code):?>
                        <li><span><?= $name ?><i></i></span></li>
                        <? endif; ?>
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

        <div class="b-cinema-list-wrap">
            <div id="ctclove_preloader"></div>

            <div class="b-cinema-list">

                <? foreach ($arResult["ITEMS"] as $key => $item):
                    $url = InitFunctions::getProjectUrl($item['ID']);
                    ?>
                    <div class="bcl-item">
                        <div class="bcl-item-image shadow">
                            <a href="<?= $url ?>">
                                <img
                                    src="<?= CFile::GetPath($item['BANNER_IN_WIDGET']['VALUE']) ?>"
                                    alt="">
                            </a>
                        </div>
                        <div class="bcl-item-info">
                            <div class="bcl-item-title">
                                <a href="<?= $url ?>"><?= $item['NAME'] ?></a>
                            </div>
                            <div class="bcl-item-desc">
                            <span><?= implode(', ', array_slice($item['FILTER_GENRES']['NAMES'], 0, 3)) ?>
                                <i class="age-category"><?= $item['MIN_AGE']['VALUE'] ?></i></span>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
                <?= $arResult["NAV_STRING"] ?>
            </div>

        </div>


    </div>

    <? else: ?>

        <div class="text-center  yellow_text"><h4>К сожалению, сейчас
                недоступны фильмы этого жанра.<br>Попробуй зайти позднее.</h4>
        </div>

    <? endif; ?>
</div>