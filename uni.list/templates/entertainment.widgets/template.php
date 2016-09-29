<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?function showBlock($key,$item){
	switch ($item['PROPERTY_WIDGET_TYPE_XML']){
		case "test":
		case "contest":
		case "quiz":
		case "vote":
		case "casting":?>
			<div class='grid-item shadow widget widget--<?=$item['WIDGET']['BG_CLASS']?> <?=$item['PROPERTY_WIDGET_TYPE_XML']?>'>
				<?if(!empty($item['DETAIL_PICTURE_SRC'])){?>
					<div class="widget__image">
						<a href="<?=$item['URL']?>"><img src="<?=$item['DETAIL_PICTURE_SRC']?>" class="img-responsive"></a>
						<a href="<?=$item['URL']?>"><i class="entertainment-icon  entertainment-icon--<?=$item['WIDGET']['PIC']?>"></i></a>
					</div>
				<?}?>
				<div class="widget__data<?=( $item['DETAIL_PICTURE_SRC']) ? " pic" : ""?>">
					<div class="widget__type"><span><?=$item['WIDGET']['CATEGORY']?></span><span class="widget__date yellow_text"><?=substr($item['DATE'],0,10)?></span></div>
					<div class="widget__name"><a href="<?=$item['URL']?>"><?=$item['NAME']?></a></div>
					<?
					switch ($item['WIDGET']['BG_CLASS']) {
						case "yellow":
							$btn_class = "violet";
							break;
						case "blue":
							$btn_class = "yellow-blue";
							break;
						default:
							$btn_class = "yellow-violet";
					}
					?>
					<div><a href="<?=$item['URL']?>" class="ctclove-btn  ctclove-btn--regular  ctclove-btn--<?=$btn_class?>"><?=$item['WIDGET']['BUTTON']['TEXT']?></a></div>
				</div>
			</div>
			<?
			break;
		case "banner240":?>
			<div class="grid-item shadow banner240 <?=$class?>">

				<? if ( $item['URL'] ): ?>
					<a href="<?=$item['URL']?>">
						<? if ( $item['DETAIL_PICTURE_SRC'] ): ?>
							<img src="<?=$item['DETAIL_PICTURE_SRC']?>" class="img-responsive">
						<? else: ?>
							<?=$item['DETAIL_TEXT']?>
						<? endif; ?>
					</a>
				<? else: ?>
					<? if ( $item['DETAIL_PICTURE_SRC'] ): ?>
						<img src="<?=$item['DETAIL_PICTURE_SRC']?>" class="img-responsive">
					<? else: ?>
						<?=$item['DETAIL_TEXT']?>
					<? endif; ?>
				<? endif; ?>

			</div>

			<?
			break;
		case "tvprogramm":
			global $APPLICATION;
			echo "<div class='grid-item shadow  widget'>";
			$APPLICATION->IncludeFile("/includes/now_on_tv.php",array());
			echo "</div>";
			break;
		case "social":?>
			<div class="grid-item shadow social-group <?=$class?>"  role="tabpanel" >
				<ul class="" role="tablist" id="socialTab">
					<li role="presentation" class="active"><a href="#vk_" aria-controls="vk" role="tab" data-toggle="tab">вконтакте</a></li>
					<li role="presentation"><a href="#ok_" aria-controls="ok" role="tab" data-toggle="tab">одноклассники</a></li>
					<li role="presentation"><a href="#fb_" aria-controls="fb" role="tab" data-toggle="tab">facebook</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="vk_">
						<div id="vk_groups"></div>
					</div>
					<div role="tabpanel" class="tab-pane" id="ok_">
						<div id="ok_group_widget"></div>
					</div>
					<div role="tabpanel" class="tab-pane" id="fb_">
						<div class="fb-page" data-href="https://www.facebook.com/ctclove" data-width="243" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/ctclove"><a href="https://www.facebook.com/ctclove">СТС Love</a></blockquote></div></div>
					</div>
				</div>
			</div>
			<?
			break;
	}
}?>

	<div class="entertainment-type-list hidden-xs">
		<a class="entertainment-type-item  ctclove-radio-btn  <?=(!$arParams['TYPE'] ? 'ctclove-radio-btn--active' : '')?>" href="<?=ENTERTAINMENT_URL?>">все</a>
		<?foreach($arResult['ENTERTAINMENT_TYPES'] as $type){?>
			<a class="entertainment-type-item  ctclove-radio-btn  <?=($arParams['TYPE']==$type['XML_ID'] ? 'ctclove-radio-btn--active' : '')?>" href="<?=ENTERTAINMENT_URL?><?=$type['XML_ID']?>/"><?=$type['MNAME']?></a>
		<?}?>
	</div>
	<div class="clearfix"></div>
<? if ( count($arResult["ITEMS"]) > 0 ): ?>
	<div class='widgets-list grid'>
		<div class="gutter-sizer"></div>
		<?foreach($arResult["ITEMS"] as $key=>$item):
			showBlock($key,$item);
		endforeach; ?>
		<div class="rcolumn js-stamp-rcolumn">
			<?foreach($arResult["R_COLUMN_ITEMS"] as $key=>$item):
				showBlock($key,$item);
			endforeach; ?>
		</div>
	</div>
	<?=$arResult["NAV_STRING"]?>
<? else: ?>
	<div class="error404">
		<?
		switch($_GET['project_code']){
			case 'vote':
				$section_name = 'опросов';
				break;
			case 'quiz':
				$section_name = 'викторин';
				break;
			case 'contest':
				$section_name = 'конкурсов';
				break;
			case 'test':
				$section_name = 'тестов';
				break;
			case 'casting':
				$section_name = 'кастингов';
				break;
			default:
				$section_name = 'развлечений';
				break;
		}
		?>
		<div>
			<div>В данный момент нет активных <?=$section_name?>. Попробуй заглянуть позже.</div>
			<img src="/bitrix/templates/main/images/broken_heart.png?2" class="img-responsive">
		</div>
		<div class="rcolumn js-stamp-rcolumn" style="text-align: left">
			<?foreach($arResult["R_COLUMN_ITEMS"] as $key=>$item):
				showBlock($key,$item);
			endforeach; ?>
		</div>
	</div>
<? endif;?>