<?php

/* 
    $arParams['VOTES'] - poll ids array

    *first item data*
    $item['PROPERTY_NAME_1_VALUE']
    $item['PICTURE_1']
    $item['PROPERTY_COUNT_1_VALUE']

    *second item data*
    $item['PROPERTY_NAME_2_VALUE']
    $item['PICTURE_2']
    $item['PROPERTY_COUNT_2_VALUE']    
    
*/
foreach ($arResult['ITEMS'] as $item):

    $votes_1 = strlen($item['PROPERTY_COUNT_1_VALUE']) > 0 ? $item['PROPERTY_COUNT_1_VALUE'] : 0;
    $votes_2 = strlen($item['PROPERTY_COUNT_2_VALUE']) > 0 ? $item['PROPERTY_COUNT_2_VALUE'] : 0;
    $votes_total = $votes_1 + $votes_2;
    $votes_1_p = round(($votes_1 / $votes_total) * 100) .'%';
    $votes_2_p = round(($votes_2 / $votes_total) * 100) .'%';
    
    $arName_1 = trim($item['PROPERTY_NAME_1_VALUE']);
    $arName_1 = explode(' ', $arName_1);
    $arName_1 = $arName_1[0].'<br>'.$arName_1[1];
    $arName_2 = trim($item['PROPERTY_NAME_2_VALUE']);
    $arName_2 = explode(' ', $arName_2);
    $arName_2 = $arName_2[0].'<br>'.$arName_2[1];

    if (in_array($item['ID'], $arParams['VOTES'])):
        // user has already voted
        ?>
        <div class="bl-vote-item  bl-vote-item_voted" data-vote-id="<?=$item['ID']?>">
            <h2 class="bl-vote-item__title"><span class="hashtag">#вонизмоды</span><?=$item['NAME']?></h2>
            <div class="bl-vote-item__persons">
                <div class="bl-loader-wrap">
                    <div class="bl-loader bl-loader_loading">
                        <div class="bl-loader__inner"></div>
                    </div>
                </div>
                <div class="bl-persons-wrap">
                    <div class="bl-person bl-person_result bl-person_selected" disabled data-option-num="1" data-votes-count="<?=$votes_1?>" data-result="<?=$votes_1_p?>">
                        <div class="bl-person__image">
                            <img src="<?=$item['PICTURE_1']?>" alt="">
                            <div class="bl-person__name">
                                <span><?= $arName_1 ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="bl-person bl-person_result bl-person_disabled" disabled data-option-num="2" data-votes-count="<?=$votes_2?>" data-result="<?=$votes_2_p?>">
                        <div class="bl-person__image">
                            <img src="<?=$item['PICTURE_2']?>" alt="">
                            <div class="bl-person__name">
                                <span><?= $arName_2 ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?
    else:
        // user hasn't voted yet
        ?>
        <div class="bl-vote-item" data-vote-id="<?=$item['ID']?>">
            <h2 class="bl-vote-item__title"><span class="hashtag">#вонизмоды</span><?=$item['NAME']?></h2>
            <div class="bl-vote-item__persons">
                <div class="bl-loader-wrap">
                    <div class="bl-loader bl-loader_empty">
                        <div class="bl-loader__inner"></div>
                    </div>
                </div>
                <div class="bl-persons-wrap">
                    <div class="bl-person" data-option-num="1" data-votes-count="<?=$votes_1?>" data-result="<?=$votes_1_p?>">
                        <div class="bl-person__image">
                            <img src="<?=$item['PICTURE_1']?>" alt="">
                            <div class="bl-person__name">
                                <span><?= $arName_1 ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="bl-person" data-option-num="2" data-votes-count="<?=$votes_2?>" data-result="<?=$votes_2_p?>">
                        <div class="bl-person__image">
                            <img src="<?=$item['PICTURE_2']?>" alt="">
                            <div class="bl-person__name">
                                <span><?= $arName_2 ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?
    endif;

endforeach; ?>

<div class="bl-pagination">
    <?echo $arResult["NAV_STRING"]; ?>
</div>
