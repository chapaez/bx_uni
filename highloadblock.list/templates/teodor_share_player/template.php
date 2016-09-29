<!doctype html public "-//w3c//dtd html 4.01//en" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>gif player | alex pankratov</title>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="/services/twitter_iframe/gif-player.js"></script>

    <style>
        <!--
        body {
            /*padding: 20px;*/
            margin: 0;
            /*font-family: calibri;*/
            /*font-size: 15px;*/
            /*background-image: url("/services/twitter_iframe/images/back.png");*/
        }
        .gif-player {
            width: 420px;
            height: 273px;
            /*            position: absolute;
                        top: 50%;
                        left: 50%;
                        margin: -210px 0 0 -160px;*/
        }
        .gif-player .canvas {
            background: #111;
            box-shadow: 0px 1px 3px #888;
            margin-bottom: 10px;
            border: 10px solid white;
        }
        .gif-player .canvas img {
            display: block;
            width: 100%;
        }
        .gif-ctrl_btn {
            margin: 0 auto;
            width: 34px;
            height: 33px;
            background-image: url('/services/twitter_iframe/images/buttons.png');
            cursor: pointer;
        }
        /*
         *	"Empty" state, show "load" button
         */
        .gif-player-e .gif-ctrl_btn       { background-position:   0px 0px }
        .gif-player-e .gif-ctrl_btn:hover { background-position: -34px 0px }
        /*
         *	"Loading" state, show "cancel" button
         */
        .gif-player-l .gif-ctrl {
            background-image: url('/services/twitter_iframe/images/cancel.gif') !important;
            background-position: 0px 0px;
        }
        .gif-player-l .gif-ctrl:hover {
            background-image: url('/services/twitter_iframe/images/buttons.png') !important;
            background-position: -34px -34px;
        }

        /*
         *	"Stopped" state, show "play" button
         */
        .gif-player-s .gif-ctrl_btn       { background-position:   0px 0px }
        .gif-player-s .gif-ctrl_btn:hover { background-position: -34px 0px }
        /*
         *	"Playing" state, show "stop" button
         */
        .gif-player-p .gif-ctrl_btn       { background-position:   0px -68px }
        .gif-player-p .gif-ctrl_btn:hover { background-position: -34px -68px }
        -->
    </style>

</head>

<body>
<div id=cont>

    <div class=gif-player>
        <div class="canvas gif-ctrl">
            <img class="gif-still" src="<?=$arResult['rows'][0]['UF_BIG_IMAGE_SRC']?>">
            <img class="gif-movie" gif="<?=$arResult['rows'][0]['UF_GIF_IMAGE_SRC']?>">
        </div>
        <div class="gif-ctrl gif-ctrl_btn">
        </div>
    </div>
    <script>
        $(document).ready( function(){
            /* preload the spinner */
            var i = new Image;
            i.src = '/services/twitter_iframe/images/cancel.gif';
            /* instantiate player(s) */
            $('.gif-player').each(function(){
                function swapWithFade(i1,i2,done) {
                    i1.fadeOut('fast', function(){
                        i2.fadeIn('fast',done);
                    });
                }

                var self = $(this);
                this.gp = new gifPlayer(self, {
                    play: swapWithFade,
                    stop: swapWithFade });
            });
        });
    </script>

</div>
</body>
</html>
