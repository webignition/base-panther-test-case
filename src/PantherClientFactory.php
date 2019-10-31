<?php declare(strict_types=1);

namespace webignition\BasePantherTestCase;

use Symfony\Component\Panther\Client as PantherClient;

class PantherClientFactory
{
    public function create(?string $baseUri = null): PantherClient
    {
        $baseUri = $baseUri ?? Options::getBaseUri();

        return PantherClient::createChromeClient(null, null, [], $baseUri);
    }

    public function destroy(PantherClient $client): void
    {
        $client->quit(false);
        $client->getBrowserManager()->quit();
    }
}
