<?php
require('rss.php');
require('dateutil.php');

$content = json_decode(file_get_contents(__DIR__ . RSS::CONFIG_FILE), true);
$rss = json_decode(file_get_contents(__DIR__ . RSS::CACHE_FILE), true) ?? [];

$images = glob('img/' . $content['image-theme'] . '/*');
$animationTypes = ['fadeInRight', 'fadeInDown', 'zoomIn', 'pulse'];
$randomImage = $images[array_rand($images)];
$randomAnimation = $animationTypes[array_rand($animationTypes)];

$rss = array_chunk($rss, 5);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quinten's startpage</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-rss/3.3.0/jquery.rss.min.js"
            integrity="sha256-+AQbFLiYSJIXah5x9QyDcwC6GXb1mcRnrfpJkSgei9g="
            crossorigin="anonymous"></script>


    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" id="color-scheme-pastel" class="color-scheme" href="/css/themes/pastel.css">
    <link rel="stylesheet" disabled id="color-scheme-nightsky" class="color-scheme" href="/css/themes/nightsky.css">
    <link rel="stylesheet" disabled id="color-scheme-grayblue" class="color-scheme" href="/css/themes/grayblue.css">
    <link rel="stylesheet" disabled id="color-scheme-activeblue" class="color-scheme" href="/css/themes/activeblue.css">

    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEACABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAAAAAAAQz3uAAsJCQA6DzYAEOf/ABPq+QAU6fsAg268AAUEBQACAgIART/wAAAPAgAJBAUAAgAGAAYCAgACBgcAGOryABPk/gACBQIADAMAAEg68wAkz9IA////AAAEAwAH6f8AAQIHACDg/wBBPPQAE+b/ABXm/wAn4vsAYlaDAAcBAgAE6f4AJl1pAAzq/AABAQEAlYHkAAkDBAAI5f8AAAMDAEFC5gAYAAQAAwMDAAoFBgA6JsAAQz3wAFQ0/QAU5f8AEAADABjl/wAV5PoAL6a+AAIBBgAS5f4AEAEAABTl/gALAgsABgABAA3l/QAHCg4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA6AAAAAAAMAAAAAAAAABIAHBgfMhwcFC0AAAAAAA05IRwiJQMdMwEKFwAAAAAbARUdDwcOKBwvLgYAAAAAKQEVHBwcHBwaKjA8AAAAAAAeCwAcJxwcKwkQAAAAAAAgOwAWHBwcHRYANgAAAAAAAAAZABwcHBwAABwmAAAAAAAAHBwdHBwcHAQ4NBMAAAAAMREcHRwdHBwcIxwiLAAAAiIcBSIiIiIIAAAiACQAACQAIgAAAAAAAAAANTcAAAAAAAAAAAAAAAAAAAAAAAAACSAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//AADwDwAAwAcAAIAHAACAAwAAgAcAAIAHAACABwAAwAcAAMADAACAAQAAgAEAAIfhAACP+QAAn/8AAP//AAA="
          rel="icon" type="image/x-icon"/>
</head>

<body>
<div class="container">
    <?php if ($content['display-welcome']): ?>
    <div class="row banner">
        <div class="col-12" style="margin-bottom: 50px;">
            <h4><?= date('j F Y', time()) ?></h4>
            <h3><?= getDayParting() ?></h3>

        </div>
    </div>
    <?php endif; ?>
    <?php if ($content['display-image']): ?>
    <div class="row banner">
        <div class="col-12" style="text-align:center; margin-bottom: 50px;">
            <img src="<?= $randomImage; ?>" id="pokemon" class="animated <?= $randomAnimation; ?>"
                 style="width:auto;height:186px">
        </div>
    </div>
    <?php endif; ?>
    <h1>Bookmarks</h1>
    <div class="row">
        <?php foreach ($content['links'] as $category => $section): ?>
            <div class="col-sm">
                <h2><?= $category ?></h2>
                <ul>
                    <?php foreach ($section as $title => $url): ?>
                        <li><a href="<?= $url ?>"><?= $title ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
          <?php endforeach; ?>
    </div>
    <div class="row" style="margin-top:50px">
        <div class="col-12">
            <h1>Latest news</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <?php foreach ($rss[0] as $rsslinks):  ?>
                <?= '<a href="' . $rsslinks['link'] . '"><li class="" aria-label="' . $rsslinks['source'] . '">' . $rsslinks['title'] . '</li></a>' ?>
            <?php endforeach ?>
        </div>
        <div class="col-12 col-md-6">
            <?php foreach ($rss[1] as $rsslinks):  ?>
                <?= '<a href="' . $rsslinks['link'] . '"><li class="" aria-label="' . $rsslinks['source'] . '">' . $rsslinks['title'] . '</li></a>' ?>
            <?php endforeach ?>
        </div>

    </div>
</div>

</div>

<script src="logic.js?ver=5" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
