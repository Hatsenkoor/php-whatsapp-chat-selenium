<?php

require_once('../driver.php');

use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

$instance = Singleton::getInstance();
$driver = $instance->getDriver();
$file_name = 'qrCode.png';

$canvas = $driver->wait(10000)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector(".landing-main canvas")));

$base64_string = $driver->executeScript("return arguments[0].toDataURL('image/png').substring(21);", [$canvas]);

if(file_exists($file_name)) unlink($file_name);
$ifp = fopen( $file_name, 'wb' ); 
$data = explode( ',', $base64_string );

fwrite( $ifp, base64_decode( $data[ 1 ] ) );
fclose( $ifp );

echo $file_name;