<?php declare(strict_types=1);

namespace webignition\BasePantherTestCase;

use webignition\BaseBasilTestCase\AbstractBaseTest;

abstract class AbstractBrowserTestCase extends AbstractBaseTest
{
    /**
     * @var WebServerRunner
     */
    private static $webServerRunner;

    /**
     * @var string|null
     */
    protected static $webServerDir;

    public static function setUpBeforeClass(): void
    {
        self::$webServerRunner = new WebServerRunner((string) realpath((string) self::$webServerDir));
        self::$webServerRunner->start();

        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        static::stopWebServer();
    }

    private static function stopWebServer()
    {
        self::$webServerRunner->stop();
    }
}
