<?php

declare(strict_types=1);

namespace webignition\BasePantherTestCase;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\Client as PantherClient;
use webignition\SymfonyPantherWebServerRunner\Options;
use webignition\SymfonyPantherWebServerRunner\WebServerRunner;

abstract class AbstractBrowserTestCase extends TestCase
{
    private const WEB_SERVER_DIR = __DIR__ . '/../fixtures/html';
    protected static PantherClient $client;
    protected static ?string $webServerDir = self::WEB_SERVER_DIR;

    protected static ?string $baseUri = null;

    private static WebServerRunner $webServerRunner;

    public static function setUpBeforeClass(): void
    {
        if (null === self::$baseUri) {
            self::$baseUri = Options::getBaseUri();
        }

        self::$webServerRunner = new WebServerRunner((string) realpath((string) self::$webServerDir));
        self::$webServerRunner->start();

        self::$client = Client::createChromeClient(null, null, [], self::$baseUri);
    }

    public static function tearDownAfterClass(): void
    {
        self::$webServerRunner->stop();
        self::$client->quit();
    }
}
