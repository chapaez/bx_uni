<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $project = CTCLove\Project::i()->getProject(); ?>
<? $count = count($arResult["ITEMS"]); ?>
<? if ( count($arResult["ITEMS"]) > 0 ): ?>
<div class="news-list__back hidden-xs shadow"></div>
<div class="news-list hidden-xs">
	<a name="news" id="news" class="anchor"></a>
    <div class="header"><span class="icon yellow_back"><i class="news"></i></span>новости</div>
    <? if ( $count > 12 ): ?>
    <div class="project_news__all">
       <a href="<?=InitFunctions::getElementUrlById($project["ID"],'projects').'/news'?>">все новости</a>
    </div>
    <? endif; ?>
    <div id="newsCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
        <ol class="carousel-indicators">
            <?
            $ceil = ceil(count($arResult['ITEMS'])/3);
            if ( $ceil > 1 ) {
                for ($i = 0; $i < $ceil; $i++): ?>
                    <li data-target="#newsCarousel" data-slide-to="<?= $i ?>" class="<?=($i==0) ? "active" : "" ?>"></li>
                <?  endfor;
            }
            ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
            <? foreach($arResult["ITEMS"] as $key=>$item):
            	$url = InitFunctions::getElementUrlById($item["ID"],'news');
            	?>
                <?if ( $key%3 == 0 && $key != 0 ) echo '</div><div class="item">';?>
                <div class="project_news__item col-md-4 col-sm-4">
                    <div class="image shadow"><a href="<?=$url?>" class="image"><img src="<?=$item['DETAIL_PICTURE_SRC']?>" class="img-responsive"/></a></div>
                    <div class="date yellow_text"><?=( strlen($item['DATE_ACTIVE_FROM']) > 0 ? substr($item['DATE_ACTIVE_FROM'], 0, 10) : substr($item['DATE_CREATE'], 0, 10) )?></div>
                    <div class="name"><a href="<?=$url?>"><?=$item['NAME']?></a></div>
                </div>
            <? endforeach; ?>
            </div>
        </div>
        <? if ( $ceil > 1 ): ?>
        <a class="left carousel-control" href="#newsCarousel" role="button" data-slide="prev"></a>
        <a class="right carousel-control" href="#newsCarousel" role="button" data-slide="next"></a>
        <? endif; ?>
    </div>
</div>
<div class="news-list visible-xs">
	<div class="header">новости</div>
	 <? 
	 for ( $i=0; $i<3; $i++):
	 	$item = $arResult["ITEMS"][$i];
	 	$url = InitFunctions::getElementUrlById($item["ID"],'news');
	 	if(is_array($item)):
	 ?>
		<div class="project_news__item col-xs-12">
        	<div class="image shadow"><a href="<?=$url?>" class="image"><img src="<?=$item['DETAIL_PICTURE_SRC']?>" class="img-responsive"/></a></div>
            <div class="date yellow_text"><?=( strlen($item['DATE_ACTIVE_FROM']) > 0 ? substr($item['DATE_ACTIVE_FROM'], 0, 10) : substr($item['DATE_CREATE'], 0, 10) )?></div>
            <div class="name"><a href="<?=$url?>"><?=$item['NAME']?></a></div>
        </div>
        <? endif;?>
	 <? endfor;?>
	<div class="clearfix"></div>
    <? if ( $count > 3 ): ?>
    <a href="<?=InitFunctions::getElementUrlById($project["ID"],'projects').'/news'?>" class="project_news__all">Все новости</a>
    <?endif;?>
</div>
<? endif; ?>