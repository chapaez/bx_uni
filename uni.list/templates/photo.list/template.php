<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if ( count($arResult["ITEMS"]) > 0 ):
?>
<h2>Фото</h2>
<div class="container">
    <div class="project-list-wrapper clearfix">
        
            <? foreach($arResult["ITEMS"] as $key=>$item):
            	$url = InitFunctions::getElementUrlById($item["ID"],'photo_gallery');
				$pic = CFile::GetPath($item["PICTURE"]);
            	?>
                <?if ( $key%2 == 0 && $key != 0 ) echo '</div><div class="item">';?>
                <div class="project_list__item col-md-4">
                    <div class="image">
                    	<a href="<?=$url?>" class="image">
	                    	<img src="<?=$pic?>" class="img-responsive"/>
	                    </a>
	                </div>
                    
                    
                    
                    
                </div>
            <? endforeach; ?>


       
    </div>
</div>
<? endif; ?>
<div class="seo-wrapper"><?=InitFunctions::getSeoText()?></div>