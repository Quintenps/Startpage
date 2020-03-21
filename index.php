<?php
require('rss.php');

$content = json_decode(file_get_contents(__DIR__.RSS::CONFIG_FILE), true);
$rss = json_decode(file_get_contents(__DIR__.RSS::CACHE_FILE), true) ?? [];

$images = glob('img/'.$content['image-theme'] .'/*');
$animationTypes = ['fadeInRight', 'fadeInDown', 'zoomIn', 'pulse'];
$randomImage = $images[array_rand($images)];
$randomAnimation = $animationTypes[array_rand($animationTypes)];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quinten's startpage</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Mono|Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-rss/3.3.0/jquery.rss.min.js"
            integrity="sha256-+AQbFLiYSJIXah5x9QyDcwC6GXb1mcRnrfpJkSgei9g="
            crossorigin="anonymous"></script>


    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" id="color-scheme-pastel" class="color-scheme" href="/css/themes/pastel.css">
    <link rel="stylesheet" disabled id="color-scheme-peekachu" class="color-scheme" href="/css/themes/peekachu.css">
    <link rel="stylesheet" disabled id="color-scheme-jungle" class="color-scheme" href="/css/themes/jungle.css">
    <link rel="stylesheet" disabled id="color-scheme-nightsky" class="color-scheme" href="/css/themes/nightsky.css">
    <link rel="stylesheet" disabled id="color-scheme-deeppurple" class="color-scheme" href="/css/themes/deeppurple.css">
    <link rel="stylesheet" disabled id="color-scheme-itonomy" class="color-scheme" href="/css/themes/itonomy.css">

    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEACABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAAAAAAAQz3uAAsJCQA6DzYAEOf/ABPq+QAU6fsAg268AAUEBQACAgIART/wAAAPAgAJBAUAAgAGAAYCAgACBgcAGOryABPk/gACBQIADAMAAEg68wAkz9IA////AAAEAwAH6f8AAQIHACDg/wBBPPQAE+b/ABXm/wAn4vsAYlaDAAcBAgAE6f4AJl1pAAzq/AABAQEAlYHkAAkDBAAI5f8AAAMDAEFC5gAYAAQAAwMDAAoFBgA6JsAAQz3wAFQ0/QAU5f8AEAADABjl/wAV5PoAL6a+AAIBBgAS5f4AEAEAABTl/gALAgsABgABAA3l/QAHCg4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA6AAAAAAAMAAAAAAAAABIAHBgfMhwcFC0AAAAAAA05IRwiJQMdMwEKFwAAAAAbARUdDwcOKBwvLgYAAAAAKQEVHBwcHBwaKjA8AAAAAAAeCwAcJxwcKwkQAAAAAAAgOwAWHBwcHRYANgAAAAAAAAAZABwcHBwAABwmAAAAAAAAHBwdHBwcHAQ4NBMAAAAAMREcHRwdHBwcIxwiLAAAAiIcBSIiIiIIAAAiACQAACQAIgAAAAAAAAAANTcAAAAAAAAAAAAAAAAAAAAAAAAACSAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//AADwDwAAwAcAAIAHAACAAwAAgAcAAIAHAACABwAAwAcAAMADAACAAQAAgAEAAIfhAACP+QAAn/8AAP//AAA="
          rel="icon" type="image/x-icon"/>
</head>

<body>
<div class="container">
    <div class="row banner">
        <div class="column column-50 column-offset-25" style="text-align:center; margin-bottom: 50px;">
            <img src="<?php echo $randomImage; ?>" id="pokemon" class="animated <?php echo $randomAnimation; ?>" style="width:auto;height:186px">
        </div>
    </div>
    <div class="row">
        <div class="column column-25">
            <h1>video</h1>
            <ul id="video">
                <?php
                foreach ($content['links']['video'] as $name => $link) {
                    echo '<a href="' . $link . '"><li>' . $name . '</li></a>';
                }
                ?>
            </ul>
        </div>
        <div class="column column-25">
            <h1>entertainment</h1>
            <ul id="entertainment">
                <?php
                foreach ($content['links']['entertainment'] as $name => $link) {
                    echo '<a href="' . $link . '"><li>' . $name . '</li></a>';
                }
                ?>
            </ul>
        </div>
        <div class="column column-25">
            <h1>graduating</h1>
            <ul id="graduating">
                <?php
                foreach ($content['links']['graduating'] as $name => $link) {
                    echo '<a href="' . $link . '"><li>' . $name . '</li></a>';
                }
                ?>
            </ul>
        </div>
        <div class="column column-25">
            <h1>other</h1>
            <ul id="other">
                <?php
                foreach ($content['links']['other'] as $name => $link) {
                    echo '<a href="' . $link . '"><li>' . $name . '</li></a>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="row" style="margin-top:50px;">
        <div class="column">
            <h1>Latest news</h1>
            <ul id="feed">
                <?php
                $linkLimit = 10;
                foreach ($rss as $rsslinks) {
                    $linkLimit--;
                    echo '<a href="' . $rsslinks['link'] . '"><li class="" aria-label="' . $rsslinks['source'] . '">' . $rsslinks['title'] . '</li></a>';

                    if ($linkLimit <= 0) {
                        break;
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>

</div>

<script src="logic.js?ver=5" type="text/javascript" charset="utf-8" async defer></script>
</body>

</html>
