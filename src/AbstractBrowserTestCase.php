<?php declare(strict_types=1);

namespace webignition\BasePantherTestCase;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Panther\Client as PantherClient;

abstract class AbstractBrowserTestCase extends TestCase
{
    /**
     * @var WebServerRunner
     */
    private static $webServerRunner;

    /**
     * @var PantherClientFactory
     */
    private static $pantherClientFactory;

    /**
     * @var PantherClient
     */
    protected static $client;

    /**
     * @var string|null
     */
    protected static $webServerDir;

    /**
     * @var string|null
     */
    protected static $baseUri;

    public static function setUpBeforeClass(): void
    {
        if (null === self::$baseUri) {
            self::$baseUri = Options::getBaseUri();
        }

        self::$webServerRunner = new WebServerRunner((string) realpath((string) self::$webServerDir));
        self::$webServerRunner->start();

        self::$pantherClientFactory = new PantherClientFactory();
        self::$client = self::$pantherClientFactory->create(self::$baseUri);
    }

    public static function tearDownAfterClass(): void
    {
        static::stopWebServer();
    }

    private static function stopWebServer()
    {
        self::$webServerRunner->stop();
        self::$pantherClientFactory->destroy(self::$client);
    }
}
