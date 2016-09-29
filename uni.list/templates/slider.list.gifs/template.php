<?  global $genres_list;?>

<div class="gifs-carousel__head">
    <h2 class="carousel-title">
        <span class="icon yellow_back hidden-xs"><i class="cinema"></i></span>
        Еще гифки
    </h2>
    <div class="carousel-filter">
        <div class="carousel-filter__all active">
            <a href="<?=$_SERVER['SHORT_TRUE_URL'] . "?filter="?>">Все гифки</a>
        </div>
        <div class="carousel-filter__select dropdown">
            <button class="carousel-filter__check dropdown-toggle" type="button" data-toggle="dropdown">Выбрать жанр
                <span class="caret"></span></button>
            <ul class="carousel-filter__list dropdown-menu">
                <? foreach ($genres_list as $code => $genre): ?>
                    <?
                    $genre_name = $genre[0];
                    $genre_code = $genre[1];
                    ?>
                    <li>
                        <a href="<?= $_SERVER['SHORT_TRUE_URL'] . "?filter=" . $genre_code ?>"
                           data-code="<?= $genre_code ?>"
                           <?= ($arResult['FILTER'] == $genre_code) ? 'class="active"' : ''?>
                        >
                           <?= $genre_name ?>
                        </a>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?
if ($arParams["CONTENT_TYPE"])
    $content_type = $arParams["CONTENT_TYPE"];
else
    $content_type = $_REQUEST["content_type"];
?>

<div class="gifs-carousel__body">
    <!--  desktop version  -->
    <div id="lookMoreCarousel" class="carousel slide hidden-xs" data-ride="carousel"
         data-interval="false">
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <?
                foreach ($arResult["ITEMS"] as $key => $item):

                    if ($key != 0 && $key % 3 == 0)
                        echo '</div><div class="item">';
                    $url = $item['DETAIL_PAGE_URL'];
                    ?>
                    <div class="project_list__item col-md-4 col-sm-4">
                        <div class="image shadow">
                            <a href="<?= $url ?>" class="image">
                                <?
                                if ($item['PROPERTY_BADGES_VALUE'] == "Премьера") {
                                    ?>
                                    <div class="premier plashka"></div>
                                    <?
                                } ?>
                                <? if ($content_type == "video") {
                                    ?>
                                    <i class="play blue mini yellow_back"></i><? /* треугольничек для видосов */
                                    ?>
                                    <?
                                } ?>
                                <? if ($content_type == "photo_gallery") {
                                    $img = CFile::GetPath($item['PICTURE']); ?>
                                    <img src="<?= $img ?>" class="img-responsive"/>
                                <? } else { ?>
                                    <img src="<?= $item['PREVIEW_PICTURE_SRC'] ?>"
                                         class="img-responsive"/>
                                <? } ?>
                            </a>
                        </div>
                        <? if ($item['PROPERTY_PROJECT_NAME']) {
                            ?>
                            <div class="project"><a
                                    href="<?= InitFunctions::getElementUrlById($item['PROPERTY_PROJECT_VALUE'], 'projects') ?>"><?= $item['PROPERTY_PROJECT_NAME'] ?></a>
                            </div>
                        <? } ?>
                        <div class="name">
                            <a href="<?= $url ?>">
                                <?= $item["NAME"] ?>
                            </a>
                        </div>
                        <? if ($item['PROPERTY_GENRES_VALUE'] || $item['PROPERTY_MIN_AGE_VALUE']) {
                            ?>
                            <div class="info"><span
                                    class="genre"><?= $item['PROPERTY_GENRES_VALUE'] ?></span><span
                                    class="age-limit"><?= $item['PROPERTY_MIN_AGE_VALUE'] ?></span>
                            </div>
                        <? } ?>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <ol class="carousel-indicators">
            <? for ($i = 0; $i < count($arResult["ITEMS"]) / 3; $i++): ?>
                <li data-target="#lookMoreCarousel" data-slide-to="<?= $i ?>"
                    class="<?= ($i == 0) ? "active" : "" ?>"></li>
            <? endfor; ?>
        </ol>
        <a class="left carousel-control" href="#lookMoreCarousel" role="button"
           data-slide="prev"></a>
        <a class="right carousel-control" href="#lookMoreCarousel" role="button"
           data-slide="next"></a>
    </div>
    <!-- mobile version -->
    <div id="lookMoreCarouselM" class="carousel slide visible-xs-block"
         data-ride="carousel" data-interval="false">
        <div class="carousel-inner" role="listbox">

            <?
            foreach ($arResult["ITEMS"] as $key => $item):
                ?>
                <div class="item<?= ($key == 0) ? " active" : "" ?>">
                    <?
                    $url = InitFunctions::getElementUrlById($item["ID"], $content_type);
                    ?>
                    <div class="project_list__item col-md-4 col-sm-4">
                        <div class="image shadow">
                            <a href="<?= $url ?>" class="image">
                                <?
                                if ($item['PROPERTY_BADGES_VALUE'] == "Премьера") {
                                    ?>
                                    <div class="premier plashka"></div>
                                    <?
                                } ?>
                                <? if ($content_type == "video") {
                                    ?>
                                    <div
                                        class="video-plashka"></div><? /* треугольничек для видосов */
                                    ?>
                                    <?
                                } ?>
                                <img src="<?= $item['PREVIEW_PICTURE_SRC'] ?>"
                                     class="img-responsive"/>
                            </a>
                        </div>
                        <? if ($item['PROPERTY_PROJECT_NAME']) {
                            ?>
                            <div
                                class="project"><?= $item['PROPERTY_PROJECT_NAME'] ?></div>
                        <? } ?>
                        <div class="name">
                            <a href="<?= $url ?>">
                                <?
                                if ($item["PROPERTY_TYPE_OF_SEASON_VALUE"] == 'обычный') {
                                    echo "Сезон " . $item['PROPERTY_SEASON_VALUE'] . " серия " . $item['PROPERTY_SERIE_IN_SEASON_VALUE'];
                                } else {
                                    echo $item["NAME"];
                                }
                                ?>
                            </a>
                        </div>
                        <? if ($item['PROPERTY_GENRES_VALUE'] || $item['PROPERTY_MIN_AGE_VALUE']) {
                            ?>
                            <div class="info"><span
                                    class="genre"><?= $item['PROPERTY_GENRES_VALUE'] ?></span><span
                                    class="age-limit"><?= $item['PROPERTY_MIN_AGE_VALUE'] ?></span>
                            </div>
                        <? } ?>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <a class="left carousel-control" href="#lookMoreCarouselM" role="button"
           data-slide="prev"></a>
        <a class="right carousel-control" href="#lookMoreCarouselM" role="button"
           data-slide="next"></a>
    </div>
</div>