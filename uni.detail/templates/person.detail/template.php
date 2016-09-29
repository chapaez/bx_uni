
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if ($arResult['ITEM']): ?>
	<div class="person-wrap">
		<div class="person-top">
			<a class="person-all" href="/<?=PERSONS_URL?>">все персоны</a>
			<div class="active-from" hidden>
				<?=substr($arResult['ITEM']['DATE_ACTIVE_FROM'],0,10)?>
			</div>
			<div class="person-photo">
				<img src="<?=$arResult['ITEM']["DETAIL_PICTURE_SRC"]?>" alt="<?=$arResult['ITEM']['NAME']?>" title="<?=$arResult['ITEM']['NAME']?>">
			</div>
<!--			<div class="person-name">
				<h3><?/*=$arResult['ITEM']['NAME']*/?></h3>
			</div>-->
			<div class="person-preview">
				<?=$arResult['ITEM']['PREVIEW_TEXT']?>
			</div>
		</div>
		<div class="person-bottom">
			<div class="person-info">
				<?=$arResult['ITEM']['DETAIL_TEXT']?>
			</div>
		</div>
	</div>
	<? // $APPLICATION->IncludeFile("/includes/shares_beautiful.php");?>  
<?
else:
	LocalRedirect("/404");
endif;