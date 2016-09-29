<?
if ($arParams["CONTENT_TYPE"])
    $content_type = $arParams["CONTENT_TYPE"];
else
    $content_type = $_REQUEST["content_type"];
?>
<div id="lookMoreCarousel" class="carousel slide hidden-xs" data-ride="carousel"
     data-interval="false">
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <?
            foreach ($arResult["ITEMS"] as $key => $item):

                if ($key != 0 && $key % 3 == 0)
                    echo '</div><div class="item">';
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
                            <i class="play blue mini yellow_back"></i>
                            <img
                                src="<?= CFile::GetPath($item['BANNER_IN_WIDGET']['VALUE']) ?>"
                                class="img-responsive"/>
                        </a>
                    </div>
                    <div class="name">
                        <a href="<?= $url ?>">
                            <?= $item["NAME"] ?>
                        </a>
                    </div>
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
                            <div
                                class="video-plashka"></div>
                            <img
                                src="<?= CFile::GetPath($item['BANNER_IN_WIDGET']['VALUE']) ?>"
                                class="img-responsive"/>
                        </a>
                    </div>
                    <div class="name">
                        <a href="<?= $url ?>"><?= $item["NAME"] ?>
                        </a>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
    <a class="left carousel-control" href="#lookMoreCarouselM" role="button"
       data-slide="prev"></a>
    <a class="right carousel-control" href="#lookMoreCarouselM" role="button"
       data-slide="next"></a>
</div>