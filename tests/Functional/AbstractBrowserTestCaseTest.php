<?php

declare(strict_types=1);

namespace webignition\BasePantherTestCase\Tests\Functional;

use Symfony\Component\Panther\DomCrawler\Crawler;
use webignition\BasePantherTestCase\AbstractBrowserTestCase;
use webignition\SymfonyPantherWebServerRunner\Options;

class AbstractBrowserTestCaseTest extends AbstractBrowserTestCase
{
    private const FIXTURES_RELATIVE_PATH = '/Fixtures';
    private const FIXTURES_HTML_RELATIVE_PATH = '/html';

    public static function setUpBeforeClass(): void
    {
        self::$webServerDir = __DIR__
            . '/..'
            . self::FIXTURES_RELATIVE_PATH
            . self::FIXTURES_HTML_RELATIVE_PATH;

        parent::setUpBeforeClass();
    }

    public function testExamineBrowser()
    {
        $crawler = self::$client->request('GET', Options::getBaseUri() . '/index.html');

        $this->assertInstanceOf(Crawler::class, $crawler);
        $this->assertSame('Test fixture web server default document', self::$client->getTitle());
    }
}
