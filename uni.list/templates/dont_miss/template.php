<div class="dont-miss-list">
	<div class="header">
		<span class="icon yellow_back hidden-xs"><i class="television_2"></i></span>
		не пропусти
	</div>
	<div id="dontMissCarousel" class="carousel slide hidden-xs" data-ride="carousel" data-interval="false">
		<div class="carousel-inner" role="listbox">
			<div class="item active">
			<?
			foreach ($arResult["ITEMS"] as $key=>$item) {
				$item["PIC_SRC"] = CFile::GetPath($item["PROPERTY_BANNER_IN_WIDGET_VALUE"]);
				$url = InitFunctions::getElementUrlById($item["ID"],'projects');
				?>
				<?if ( $key%3 == 0 && $key != 0 ) echo '</div><div class="item">';?>
				<div class="dont-miss-item col-sm-4 shadow">
					<div class="dont-miss-item-img">
						<a href="<?=$url?>"><img src="<?=$item["PIC_SRC"]?>" class="img-responsive"></a>
						<span class="min_age">
		        			<span class="back"></span>
			        		<span class="val"><?=$item["PROPERTY_MIN_AGE_VALUE"]?></span>
			        	</span>
					</div>
				</div>
				<?
			}?>
			</div>
		</div>
		<ol class="carousel-indicators">
	    <? for ($i=0; ($i < $arResult['SLIDER_PAGES'] && $i < 4 && $arResult['SLIDER_PAGES'] > 1 ); $i++): ?>
	    	<li data-target="#dontMissCarousel" data-slide-to="<?=$i?>" class="<?=($i==0) ? "active" : "" ?>"></li>
	    <? endfor; ?>
	    </ol>
	    <? if ( $arResult['SLIDER_PAGES'] > 1 ): ?>
		<a class="left carousel-control" href="#dontMissCarousel" role="button" data-slide="prev"></a>
	    <a class="right carousel-control" href="#dontMissCarousel" role="button" data-slide="next"></a>
		<? endif; ?>
	</div>
	<div class="visible-xs">
		 <? 
		 for ( $i=0; $i<3; $i++):
		 	$item = $arResult["ITEMS"][$i];
		 	$item["PIC_SRC"] = CFile::GetPath($item["PROPERTY_BANNER_IN_WIDGET_VALUE"]);
		 	$url = InitFunctions::getElementUrlById($item["ID"],'projects');
		 ?>
		 	<div class="dont-miss-item col-xs-12 shadow">
				<div class="dont-miss-item-img">
					<a href="<?=$url?>"><img src="<?=$item["PIC_SRC"]?>"></a>
					<span class="min_age">
	        			<span class="back"></span>
		        		<span class="val"><?=$item["PROPERTY_MIN_AGE_VALUE"]?></span>
		        	</span>
				</div>
			</div>
		<? endfor; ?>
	</div>
</div>