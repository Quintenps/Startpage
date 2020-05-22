<?php

function getDayParting()
{
    $time = date("H");
    if ($time < "12") {
        echo "Good morning!";
    }
    if ($time >= "12" && $time < "17") {
        echo "Good afternoon!";
    }
    if ($time >= "17" && $time < "19") {
        echo "Good evening!";
    }
    if ($time >= "19") {
        echo "Good night!";
    }
}
