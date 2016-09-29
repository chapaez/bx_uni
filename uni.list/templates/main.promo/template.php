<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="mainPromoCarousel" class="carousel slide stamp shadow" data-ride="carousel" data-interval="300000">
    <div class="carousel-inner" role="listbox">
        <? foreach($arResult["ITEMS"] as $key=>$item):?>
        <div class="item<?=($key==0)?" active":""?>">
                <div class="image"><a href="<?=$item['URL']?>" class="image"><img src="<?=$item['SLIDER_IMAGE']?>" class="img-responsive"/></a></div>
                <div class="info violet_back">
                	<div class="cell">
	                		<div class="name  <?=( $item['IBLOCK_CODE'] == "projects" ? "hidden-xs" : "long" )?>"><a href="<?=$item['URL']?>" class="yellow_text"><?=$item['~NAME']?></a></div>
	                		<?if ( $item['IBLOCK_CODE'] == "projects" ) {?>
		        				<div class="genre">
		        					<span class="hidden-xs"><?=$item["PROPERTY_GENRES_VALUE"]?></span>
		        					
		        					<span class="min_age">
		        						<span class="back"></span>
		        						<span class="val"><?=$item['PROPERTY_MIN_AGE_VALUE']?></span>
		        					</span>
		        					
		        				</div>
	        				<?}?> 	
                	</div>
                	<?if ( $item['IBLOCK_CODE'] == "projects" ) {?>
                	<div class="cell">
                		<? if ($item['PROPERTY_BADGES_VALUE']): ?>
        					<div class="mbadge"><?=$item['PROPERTY_BADGES_VALUE']?></div>
        				<? endif; ?>
                		<div class="date yellow_text">
                		<? if ($item['TIME'] && !$item['PROPERTY_TIME_SLOT_VALUE']): ?>
                			<i class="mdi mdi-clock"></i><?=$item['TIME']?>
                		<? else: ?>
                			<i class="mdi mdi-clock"></i><?=$item['~PROPERTY_TIME_SLOT_VALUE']?>
                		<? endif; ?>
                		</div>  
                	</div>       	
                	<?}?>
        		</div>
			<? if ( $item['IBLOCK_CODE'] == "projects" ): ?>
				<a href="<?=$item['URL']?>"><i class="play hidden-xs"></i></a>
			<? endif; ?>
        </div>
        <? endforeach; ?>
    </div>
    <ol class="carousel-indicators">
    <? for ($i=0; $i < count($arResult["ITEMS"]); $i++): ?>
    	<li data-target="#mainPromoCarousel" data-slide-to="<?=$i?>" class="<?=($i==0) ? "active" : "" ?>"></li>
    <? endfor; ?>
    </ol>
    <a class="left carousel-control" href="#mainPromoCarousel" role="button" data-slide="prev"></a>
    <a class="right carousel-control" href="#mainPromoCarousel" role="button" data-slide="next"></a>
</div>