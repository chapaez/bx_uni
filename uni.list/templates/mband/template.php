<?php
/**
 * Created by PhpStorm.
 * User: vnilov
 * Date: 09.10.15
 * Time: 15:51
 */

if (count($arResult['ITEMS']) > 0 ):
    //var_dump($arParams);die();
    foreach ($arResult['ITEMS'] as $key=>$item):
            if($item['IBLOCK_CODE']=='vk_video'): ?>
                <div class="casting__item vk">
                    <div class="casting__description  flag  flag--small">
                        <div class="flag__img">
                            <img src="<?=CFile::GetPath($item['PROPERTY_USER_PICTURE_VALUE'])?>">
                        </div>
                        <div class="flag__body">
                            <?=$item['PROPERTY_USER_NAME_VALUE']?>
                        </div>
                    </div>
                    <div class="casting__video">
                        <video controls poster="<?=CFile::GetPath($item['PROPERTY_PACKSHOT_VALUE'])?>">
                            <source src="<?=$item['PROPERTY_VIDEO_VALUE']?>">
                        </video>
                    </div>
    
                </div>
            <? else: ?>
                <div class="casting__item">
                    <?=$item['~PROPERTY_VIDEO_VALUE']?>
                </div>
            <? endif; ?>
        <?
    endforeach;
    ?>
    <? if($arResult['PAGES'] != $arParams['PAGE']): ?>
        <a href="<?=PROJECT_DIR?>next.php?p=<?=($arParams['PAGE']+1)?>">next page</a>
    <?else:?>
        <div id="finish"></div>
    <?endif?>
<?else:?>
В данный момент нет работ
<?endif;?>