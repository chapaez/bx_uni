
<?if(!$arParams["ATA_AJAX_MODE"]){?>
<div class="media-filter  js-stamp ">
    <select class="media-sort js-media-sort  selectpicker  hidden-xs"  data-style="ata-select">
        <option value="new">по новизне</option>
        <option value="popular">по популярности</option>
    </select>

    <select class="media-sort js-media-filter__star  selectpicker  "  data-style="ata-select">
        <option value="">вопросы всем ведущим</option>
        <?foreach($arParams['GURU'] as $guru){?><option value="<?=$guru['code']?>"><?=$guru['plashka']?></option><?}?>
    </select>

    <a href="" class="js-media-filter__item  media-filter__item  hidden-xs ">с ответами</a>
    
</div>
<div style="width: 100%"></div>
    <div class="js-items">
<?}?>


        <?foreach($arResult['ITEMS'] as $key => $item){
            ?>
            <div class="media-list__item js-media-list__item  box">
                <span class="media-list__plashka">вопрос <?=$item['GURU']['plashka']?></span>
                <div class="media-list__description  box  box--flush"><?=$item['DETAIL_TEXT']?></div>
                
                
                <div class="like  like--violet  js-media-list__likes <?=($item['I_LIKE'] ? "like--active" : "")?>"  data-cid="<?=$item["ID"]?>">
                    <i class="like__icon  icon--like  "></i>
                    <span class="like__count  js-media-list__likes_count"><?=$item['LIKES_COUNT']?></span>
                </div>
                
                <div class="flag  flag--flush  u-mt  u-mb">
                    <img src="<?=$item['DETAIL_PICTURE_SRC']?>" width="100" class="flag__img  media-list__avatar  u-mr">
                    <div class="flag__body  media-list__username"><?=$item["NAME"]?></div>
                </div>
                <?
                    if($item["PROPERTY_VMID_ANSWER_VALUE"]){
                        ?>
                        <a href=""  data-toggle="modal" data-target="#vid-modal_<?=$item['ID']?>" class="media-list__show_answer js-media-list__show_video_answer  [ ctclove-btn  ctclove-btn--regular  ctclove-btn--violet ]">смотреть видеоответ</a>
                        <div id="vid-modal_<?=$item['ID']?>" class="modal fade  media-list__video_answer js-media-list__video_answer" data-vmid="<?=$item["PROPERTY_VMID_ANSWER_VALUE"]?>" data-vmqid="<?=$item['VIDEO_ANSWER']['QUOTE_ID']?>" data-url="<?=$item['VIDEO_ANSWER']['URL']?>">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content popup__content">
                                    <div>
                                        <div class="js-embed_obj" id="embed_obj<?=$item['ID']?>">
                                        </div>
                                        <iframe frameborder='0' width='704' height='528' src='http://videomore.ru/embed/<?=$item['PROPERTY_VMID_ANSWER_VALUE']?>?skin_id=14'></iframe>

                                    </div>
                                </div>
                                <div class="popup__close" data-dismiss="modal"><span class="mdi mdi-close-circle"></span></div>
                            </div>
                        </div>

                        <?
                    }elseif($item["PREVIEW_TEXT"]){//есть текстовый ответ
                        ?>
                        <a href="" class="media-list__show_answer js-media-list__show_answer  [ ctclove-btn  ctclove-btn--regular  ctclove-btn--blue ] ">смотреть ответ</a>
                        <div class="media-list__text_answer js-media-list__text_answer">
                            <?/*<span class="media-list__plashka_answer">ответ</span>*/?>
                            <div class="media-list__description"><?=$item['PREVIEW_TEXT']?></div>
                            <?if($item['GURU']['code']){?>
                                <div class="flag  flag--flush  u-mt  u-mb">
                                    <img src="<?=$item['GURU']['pic']?>" width="100" class="flag__img  media-list__avatar  u-mr">
                                    <div class="flag__body  media-list__username"><?=$item['GURU']['name']?></div>
                                </div>
                            <?}?>

                        </div>
                        <?
                    }
                ?>

            </div>

            <?
        }?>

<?if(!$arParams["ATA_AJAX_MODE"]){?>
    </div>
    <?/*<div class="media-list__gutter"></div>*/?>

    <?if($arResult['PAGES']>1){?>
        <script>
            $(function(){$('.js-media-list__btn').parent().removeClass('hidden');});
        </script>
    <?}?>

<?}?>
<?if ( $arParams["ATA_AJAX_MODE"]  &&  $arParams['PAGE'] == $arResult['PAGES'] ):?>
    <script>
        $('.js-media-list__btn').parent().hide();
    </script>
<?else:?>
    <script>
        $('.js-media-list__btn').parent().show();
    </script>

<?endif;?>



