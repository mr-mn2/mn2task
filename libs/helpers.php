<?php
function diePage($msg)
{
    echo "<div style ='padding: 20px; background-color: #ff6e6e; font-size: 24px; width: 80%; margin: 23px auto; border: #7c5252 solid 4px; border-radius: 16px; font-family: sans-serif;'>".$msg."</div>";
    die();
}
function dd($arr)
{
    echo "<pre style ='padding: 20px; background-color: #ffd7d7; font-size: 24px; width: 80%; margin: 23px auto; border-left: #7c5252 solid 6px; border-radius: 16px; font-family: sans-serif; color: #7e3b3b; }'>";
    print_r($arr);
    echo "</pre>";
    die();
}
function d($arr)
{
    echo "<pre style ='padding: 20px; background-color: #ffd7d7; font-size: 24px; width: 80%; margin: 23px auto; border-left: #7c5252 solid 6px; border-radius: 16px; font-family: sans-serif; color: #7e3b3b; }'>";
    print_r($arr);
    echo "</pre>";
}
function siteUrl($uri = '')
{
    return BASE_URL.$uri;
}
?>