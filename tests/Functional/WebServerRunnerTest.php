<?php declare(strict_types=1);

namespace webignition\BasePantherTestCase\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Panther\ProcessManager\WebServerManager;
use webignition\BasePantherTestCase\WebServerRunner;

class WebServerRunnerTest extends TestCase
{
    public function testStartStop()
    {
        $webServerDir = __DIR__ . '/../Fixtures/html';

        $webServerRunner = new WebServerRunner($webServerDir);
        $this->assertNull($this->getWebServerManager($webServerRunner));

        $webServerRunner->start();
        $this->assertTrue($this->getWebServerManager($webServerRunner)->isStarted());

        $webServerRunner->stop();
        $this->assertNull($this->getWebServerManager($webServerRunner));
    }

    private function getWebServerManager(WebServerRunner $webServerRunner): ?WebServerManager
    {
        $reflectionObject = new \ReflectionObject($webServerRunner);
        $property = $reflectionObject->getProperty('webServerManager');
        $property->setAccessible(true);

        /* @var WebServerManager $webServerManager */
        $webServerManager = $property->getValue($webServerRunner);

        return $webServerManager;
    }
}
