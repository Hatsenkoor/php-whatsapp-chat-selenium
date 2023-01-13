<?php
    require_once('vendor/autoload.php');
    use Facebook\WebDriver\Chrome\ChromeOptions;
    use Facebook\WebDriver\Chrome\ChromeDriver;
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Facebook\WebDriver\Remote\RemoteWebDriver;
    use Facebook\WebDriver\WebDriverExpectedCondition;
    use Facebook\WebDriver\WebDriverBy;

    class Singleton {
        private static ?Singleton $instance = null;
        private $webDriver;
    
        public function __construct(){}

        public function setDriver()
        {
            $serverUrl = 'http://localhost:9515';
            $sessionPath = "E:\session";
    
            $desiredCapabilities = DesiredCapabilities::chrome();
    
            // Add arguments via FirefoxOptions to start headless firefox
            $options = new ChromeOptions();
            $options->addArguments(["-user-data-dir=".$sessionPath]);
            $options->addArguments(['-disable-extensions']);
            $options->addArguments(['-disable-dev-shm-usage']);
            $options->addArguments(['-disable-gpu']);
            //$options->addArguments(['-headless']);
            $options->addArguments(['user-agent=user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36']);
            $desiredCapabilities->setCapability(ChromeOptions::CAPABILITY, $options);
    
            $this->webDriver = RemoteWebDriver::create($serverUrl, $desiredCapabilities);
    
            // Go to URL
            $this->webDriver->get('https://web.whatsapp.com');
            //$this->webDriver->get('https://www.w3schools.com/php/php_superglobals.asp');
        }
    
        public static function getInstance(): Singleton
        {
            if(self::$instance == null)
            {
                self::$instance = new self();
                self::$instance->setDriver();
            }
        
            return self::$instance;
        }
        
        public function getDriver()
        {
            return $this->webDriver;
        }
    }
    
