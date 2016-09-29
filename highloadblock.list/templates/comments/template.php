<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false; 
}
//mdump($arResult);
foreach ($arResult['rows'] as $row){
	?>
	<div class="comments-list__item clearfix">
		<div class="comments-media__img  hidden-xs">
			<div style="background-image:url('<?=$row["AUTHOR"]["AVATAR"]["SRC"]?>');" class="comments-img  crop-image"></div>
		</div>
		<div class="comments-media__body">
			<div class="">
				<span class="comments-username"><?=(strlen($row["AUTHOR"]["USER_NAME"])>1)?$row["AUTHOR"]["USER_NAME"]:"Безымянный"?></span>
				<span class="comments-separator">|</span> 
				<span class="comments-date"><?=FormatDate('d F Y H:i', MakeTimeStamp($row["UF_DATE_CREATE"]))?></span> 
				<div class="comments-likes  js-comments-likes">
					<a href="#" data-cid="<?=$row["ID"]?>" class="comments-likes__href  <?=($row['I_LIKE'])?"comments-likes__href--active":""?>"></a><span class="comments-likes__count  <?=($row['I_LIKE'])?"comments-likes__count--active":""?>"><?=$row["LIKES_COUNT"]?></span>
				</div>
				<?if($arParams["USER_IS_ADMIN"]){?>
				<a href="" class="comments-remove  js-comments-remove" data-id="<?=$row["ID"]?>"><strong>Удалить</strong></a>
				<?}?>
			</div>
			<div class="comments-text">
				<?=$row["UF_COMMENT"]?>
			</div>
			<a href="#commentText" class="[ btn  btn--small  btn--violet ]  js-answer"  data-scroll>ответить</a>
		</div>
	</div>
	<?
}
?>
