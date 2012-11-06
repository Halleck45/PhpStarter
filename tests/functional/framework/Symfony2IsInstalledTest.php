<?php

namespace halleck45\phpstarter\tests\functional;

require_once __DIR__ . '/../../bin/phpunit.phar';
require_once __DIR__ . '/../../bin/goutte.phar';

use \Goutte\Client;

class Symfony2IsInstalledTest extends \PHPUnit_Framework_TestCase {

    private $client;
    private static $url;
    private static $destination;
    private static $commandToTest;

    public static function setUpBeforeClass() {
        self::$url = 'test-install-sf2';
        self::$destination = '/tmp/test-install-sf2/';

        self::$commandToTest = 'sudo phing'
                . ' -Dframework=symfony21'
                . sprintf(' -Ddestination=%s', self::$destination)
                . sprintf(' -Dvhost=%s', self::$url)
                . ' %s';

        // phing
        chdir(__DIR__.'/../../../');
        shell_exec(sprintf(self::$commandToTest, 'install'));
    }

    public function setup() {
        $this->client = new Client();
    }

    public static function tearDownAfterClass() {
        // phing
        shell_exec(sprintf(self::$commandToTest, 'remove'));
    }

    public function testSymfony2IsDownloaded() {
        $file = self::$destination . 'LICENSE';
        $this->assertTrue(\file_exists($file), 'Licence file not found');
        $content = \file_get_contents($file);
        $this->assertRegExp('!Fabien Potencier!', $content, 'Licence file doesn\'t concern Symfony');
    }

    public function testSymfony2SiteReturnsValidHttpResponse() {
        $this->client->request('GET', 'http://' . self::$url.'/app_dev.php');
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatus(), "New site must returns the Http response 200");
    }

}