<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if ( count($arResult['ITEMS']) > 0 ): ?>
			<div class="item active">
            <? foreach ( $arResult['ITEMS'] as $key => $item ): 
                if ($arParams['CONTENT_TYPE'] == "photo_gallery")
                    $url = InitFunctions::getElementUrlById($item["ID"],'photo_gallery');
                else
            	    $url = InitFunctions::getElementUrlById($item["ID"],'video');
            	?>
                <?if ( $key%3 == 0 && $key != 0 ) echo '</div><div class="item">';?>
                <div class="project_exclusive__item col-sm-4">
                		
                    <div class="image shadow"><a href="<?=$url?>">
                    	<?if($item["PICTURE"]){
							$img = CFile::GetPath($item['PICTURE']);?>
							<img src="<?=$img?>" class="img-responsive"/>
						<?}else {?>
							<i class="play blue yellow_back"></i>
							<img src="<?=$item['DETAIL_PICTURE_SRC']?>" class="img-responsive"/>
						<?}?>
                    </a></div>
                    <div class="name"><a href="<?=$url?>"><?=$item['NAME']?></a></div>
                </div>
            <? endforeach; ?>
			</div>
<? endif; ?>