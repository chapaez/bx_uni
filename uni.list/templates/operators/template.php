<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="col-sm-6">
	<? $k = true; ?>
	<? foreach ( $arResult['ITEMS'] as $idx => $item ): ?>
		<? 
		if( $idx == ceil(count($arResult['ITEMS'])/2) && $k) {
			echo '</div><div class="col-sm-6">';
			$k = false;
		}
		?>
		<div>
			<span class="name"><?=$item['NAME']?></span>
			<div class="operators"><?=$item['~DETAIL_TEXT']?></div>
		</div>
	<? endforeach;?>
</div>