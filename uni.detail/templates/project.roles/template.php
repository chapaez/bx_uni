
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global  $project;?>

<? if ($arResult['ITEM']): ?>
	<div class="person-wrap">
		<div class="person-top">
			<div class="active-from">
				<?=substr($arResult['ITEM']['DATE_ACTIVE_FROM'],0,10)?>
			</div>
			<div class="person-photo">
				<img src="<?=$arResult['ITEM']["DETAIL_PICTURE_SRC"]?>">
			</div>
			<div class="person-name">
				<h3><?=$arResult['ITEM']['NAME']?></h3>
			</div>
			<div class="person-preview">
				<?=$arResult['ITEM']['PREVIEW_TEXT']?>
			</div>
		</div>
		<div class="person-bottom">
			<div class="person-info">
				<?=$arResult['ITEM']['DETAIL_TEXT']?>
				<div class="person-info-role">
					Роль исполняет: 
					<?if($arResult['ITEM']["PROPERTY_PERSON_ACTIVE"]=="Y"){//ссылка на персону
					$url = InitFunctions::getElementUrlById($arResult['ITEM']["PROPERTY_PERSON_VALUE"],'persons');
					?>
					<a href="<?=$url?>"><?=$arResult['ITEM']["PROPERTY_PERSON_NAME"]?></a>
				<?}elseif($arResult['ITEM']["PROPERTY_PERSON_ACTIVE"]=="N") {?>
					<?=$arResult['ITEM']["PROPERTY_PERSON_NAME"]?>
				<?}?>
				</div>
			</div>
		</div>
		<a href="<?=InitFunctions::getProjectUrl($project['ID']).ROLES_URL?>" class="person-all">
			Все герои
		</a>
	</div>
<?else:
	LocalRedirect("/404");
endif;
?>