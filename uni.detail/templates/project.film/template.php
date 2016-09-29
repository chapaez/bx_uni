<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $project = CTCLove\Project::i()->getProject(); ?>
<div class="project_video__header big-video-wrap"
     data-id="<?= $project['ID'] ?>">
    <i class="play blue yellow_back hidden-xs"></i>
    <h2><?= $project['NAME'] ?></h2>
</div>
<!-- Scheme.org -->
<div itemscope itemtype="http://schema.org/Movie">
    <meta itemprop="alternativeHeadline" content="<?= $project['NAME'] ?>">
    <meta itemprop="dateReleased" content="<?= $arResult['DATE'] ?>">
    <div itemprop="video" itemscope itemtype="http://schema.org/VideoObject">
        <meta itemprop="url" content="<?= $_SERVER['TRUE_URL'] ?>">
        <meta itemprop="name" content="<?= $project['NAME'] ?>">
        <meta itemprop="description"
              content="<?= strip_tags($project['DETAIL_TEXT']) ?>">
        <meta itemprop="duration" content="<?= $arResult['DURATION'] ?>">
        <meta itemprop="uploadDate" content="<?= $arResult['DATE'] ?>">
        <span itemprop="thumbnail" itemscope
              itemtype="http://schema.org/ImageObject">
        <meta itemprop="contentUrl"
              content="http://<?= $_SERVER['SERVER_NAME'] . $project['PROPERTY_BANNER_IN_SLIDER_SRC'] ?>">
        <meta itemprop="width"
              content="<?= $arResult['PICTURE_SIZE']['WIDTH'] ?>">
        <meta itemprop="height"
              content="<?= $arResult['PICTURE_SIZE']['HEIGHT'] ?>">
        </span>
        <!-- Player -->
        <div class="project_video__player shadow" id="player">
            <div id="embed_obj"></div>
            <iframe frameborder='0' width='704' height='528'
                    src='https://videomore.ru/embed/<?= $arResult['VID'] ?>?skin_id=14'></iframe>
        </div>
        <!-- /Player -->
    </div>
</div>
<!-- /Scheme.org -->
<? $APPLICATION->IncludeFile("/includes/social.php"); ?>
<div class="project_video__embed"></div>
<script>var vid = <?= $arResult['VID'] ?>;</script>
<div class="clearfix"></div>
