<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if ( count($arResult["ITEMS"]) > 0 ):
?>
	<div class="person-wrap">
		<div class="person-list">
			<? foreach($arResult["ITEMS"] as $key=>$item):
				$url = InitFunctions::getElementUrlById($item["ID"],'roles');
				?>
				<a href="<?=$url?>" class="person-item">
					<div class="pi-photo">
						<img src="<?=$item['DETAIL_PICTURE_SRC']?>" alt="" title="">
					</div>
					<div class="active_from hide"><?=substr($item["DATE_ACTIVE_FROM"],0,10)?></div>
					<div class="pi-name"><?=$item['NAME']?></div>
				</a>
			<? endforeach; ?>
			</div>
		<?=$arResult["NAV_STRING"]?>
	</div>
<? endif; ?>
<?/*<div class="seo-wrapper"><?=InitFunctions::getSeoText()?></div>*/?>
