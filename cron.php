<?php

require_once('rss.php');

$content = json_decode(file_get_contents(__DIR__ .'/config.json'), true);

$rss = new rss($content['rss']);

if ($rss->isCacheExpired()) {
    echo 'Cron cache expired! Renewing now..';
    $rss->getXml();
}
