<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $project = CTCLove\Project::i()->getProject(); ?>
<? if ($arResult['ITEM']):?>
<? $last_serie = Initfunctions::getLastSerie($arResult['ITEM']['PROPERTY_PROJECT_VALUE']);?>
<div class="project_video__header big-video-wrap" data-id="<?=$arResult['ITEM']["ID"]?>">
	<i class="play blue yellow_back hidden-xs"></i>
	
    	<h3 class="<?= $arParams['PROJECT_NAME'] == 'О канале' ? 'about-channel-title' : '' ?>"><?=$arResult["ITEM"]["NAME_OF_SEASON"]?> <?=$arResult['ITEM']["NAME"]?></h3>
    
    <?if($arParams['PROJECT_NAME'] != 'О канале'){?>
    	<h2><?=$arParams['PROJECT_NAME']?></h2>
    <?}?>
</div>

<!-- Scheme.org -->
<? $movie = false; ?>
<? if ($project['PROPERTY_TYPE_OF_PROJECT_VALUE'] == "Шоу") {?>
	<div itemscope itemtype="http://schema.org/TVShow"> 
<? } elseif ($project['PROPERTY_TYPE_OF_PROJECT_VALUE'] == "Сериал") { ?>
	<div itemscope itemtype="http://schema.org/TVEpisode">
<? } else { ?>
	<div itemscope itemtype="http://schema.org/Movie">	
	<? 
        $movie = true;
        $movie_data = VideomoreApi::getVideos($project['PROPERTY_VM_PID_VALUE']);
    ?>
<? } ?>
	<meta itemprop="alternativeHeadline" content="<?= $arResult['ITEM']['NAME'] ?>">
	<meta itemprop="dateReleased" content="<?= $arResult['DATE'] ?>">
	<? if (!$movie && $arResult['ITEM']['PROPERTY_TYPE_OF_SEASON_VALUE']): ?>
		<meta itemprop="partOfSeason" content="<?= $arResult['ITEM']['PROPERTY_SEASON_VALUE'] ?>">
	<? endif; ?>
	<div itemprop="video" itemscope itemtype="http://schema.org/VideoObject">
		<meta itemprop="url" content="<?= $_SERVER['TRUE_URL'] ?>" >
		<meta itemprop="name" content="<?= $arResult['ITEM']['NAME'] ?>">
		<meta itemprop="description" content="<?= strip_tags($arResult['ITEM']['DETAIL_TEXT']) ?>">
		<? if (isset($arResult['ITEM']['DURATION'])): ?>
			<meta itemprop="duration" content="<?= $arResult['ITEM']['DURATION'] ?>">
		<? endif; ?>
		<meta itemprop="uploadDate" content="<?= $arResult['DATE'] ?>">
 		<span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject" >   
			<meta itemprop="contentUrl" content="http://<?= $_SERVER['SERVER_NAME'] . $arResult['ITEM']['DETAIL_PICTURE_SRC'] ?>">
			<meta itemprop="width" content="<?= $arResult['ITEM']['DETAIL_PICTURE_SIZE']['WIDTH'] ?>">
			<meta itemprop="height" content="<?= $arResult['ITEM']['DETAIL_PICTURE_SIZE']['HEIGHT'] ?>">
		</span>
		<div class="project_video__player shadow" id="player">
		<? if ( $arResult['ITEM']['ID'] == $last_serie['ID']): ?>
			<div class="title hidden-xs">новая серия</div>
		<? endif;?>
		<div id="embed_obj"></div>
		<iframe frameborder='0' width='704' height='528' src='https://videomore.ru/embed/<?=$arResult['ITEM']['PROPERTY_VM_ID_VALUE']?>?skin_id=14'></iframe>
		</div>
	</div>
	
</div>
<!-- /Scheme.org -->
		
<div class="project_video__description">
<?
if (strlen($arResult['ITEM']['DETAIL_TEXT']) > 1000){
	?>
	<div class="short-descr short-item"><?=InitFunctions::smart_cut_text($arResult['ITEM']['DETAIL_TEXT'],$length = 1000,$etc = '',$charset='UTF-8',$break_words = false,$middle = false);?></div>
	<div class="full-descr full-item hidden"><?=$arResult['ITEM']['DETAIL_TEXT']?></div>
	<div class="btn-readmore short-item">читать далее</div>
	<div class="btn-readmore full-item hidden">скрыть</div>
	<?
} else {
	echo $arResult['ITEM']['DETAIL_TEXT'];
}?>
<div class="clearfix"></div>
<?$APPLICATION->IncludeFile("/includes/social.php");?>  
</div>
<div class="project_video__embed"></div>
<script>var vid = <?=$arResult['ITEM']['PROPERTY_VM_ID_VALUE']?>;</script>
<? if (isset($arResult['FIRST_SERIE_URL']) && $arResult['FIRST_SERIE_ID'] != $arResult['ITEM']['ID']): ?>
		<div class="watch_from_the_begin">
			<a href="<?=$arResult['FIRST_SERIE_URL']?>" class="button centered yellow-blue" onclick="ga('send', 'event', 'Button', 'Watch from the beginning');">смотреть с первой серии</a>
		</div>
	<? endif;?>
<? endif; ?>
