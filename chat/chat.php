<?php
require_once('../driver.php');

use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

$instance = Singleton::getInstance();
$driver = $instance->getDriver();

$data = json_decode($_POST['data']);

foreach ($data as $row) {
    sendMessage($row);
}

echo 200;

function sendMessage($row = null)
{
    if($row === null) return;

    $phone = $row[0];
    $message = $row[1];

    if(strlen($phone) == 0) return;
    if(strlen($message) == 0) return;

    $driver->findElement(WebDriverBy::cssSelector("div[data-testid='chat-list-search']"))->clear();
    $driver->findElement(WebDriverBy::cssSelector("div[data-testid='chat-list-search']"))->sendKeys($phone);

    $driver->wait(1000)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector("div[data-testid='cell-frame-container']")))->click();
    
    $driver->wait(1000)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector("p[class='selectable-text copyable-text']")))->sendKeys($message);
    $driver->wait(1000)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector("div[data-testid='cell-frame-container']")))->click();
}