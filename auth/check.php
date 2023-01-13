<?php

require_once('../driver.php');

$instance = Singleton::getInstance();
$driver = $instance->getDriver();

$strCurrentHtmlContent = $driver->getPageSource();

$status = 404;

if(str_contains($strCurrentHtmlContent, "community"))
{
    $status = 200;
}

if(str_contains($strCurrentHtmlContent, "To use WhatsApp on your computer:"))
{
    $status = 401;
}

echo $status;