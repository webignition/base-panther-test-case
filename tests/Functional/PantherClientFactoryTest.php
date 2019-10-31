<?php declare(strict_types=1);

namespace webignition\BasePantherTestCase\Tests\Functional;

use PHPUnit\Framework\TestCase;
use webignition\BasePantherTestCase\PantherClientFactory;
use webignition\BasePantherTestCase\WebServerRunner;
use Symfony\Component\Panther\Client as PantherClient;

class PantherClientFactoryTest extends TestCase
{
    /**
     * @var WebServerRunner
     */
    private $webServerRunner;

    protected function setUp(): void
    {
        parent::setUp();

        $webServerDir = __DIR__ . '/../Fixtures/html';

        $this->webServerRunner = new WebServerRunner($webServerDir);
        $this->webServerRunner->start();
    }

    public function testCreateDestroy()
    {
        $factory = new PantherClientFactory();
        $client = $factory->create();

        $this->assertInstanceOf(PantherClient::class, $client);

        $client->request('GET', '/index.html');
        $this->assertSame('Test fixture web server default document', $client->getTitle());

        $factory->destroy($client);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->webServerRunner->stop();
    }
}
