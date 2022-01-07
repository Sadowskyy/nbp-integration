<?php
declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Currency;
use App\Domain\CurrencyApiIntegration;
use Ramsey\Uuid\Uuid;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurrencyApiIntegrationImpl implements CurrencyApiIntegration
{
    public function __construct(private HttpClientInterface $httpClient)
    {
    }

    public function getData(): array
    {
        $response = $this->httpClient->request('GET', self::API)->getContent();
        $data = json_decode($response, true)[0]['rates'];
        $currencies = [];

        foreach ($data as $currency) {
            $currency = new Currency(
                id: Uuid::uuid4()->toString(),
                name: $currency['currency'],
                currencyCode: $currency['code'],
                currencyExchange: $currency['mid']
            );

            $currencies[$currency->getId()] = $currency;
        }

        return $currencies;
    }
}