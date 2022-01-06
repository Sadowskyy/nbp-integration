<?php
declare(strict_types=1);

namespace App\Domain;

use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CurrencyRepository::class)
 */
class Currency implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $currencyCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $currencyExchange;


    public function __construct(string $id, string $name, string $currencyCode, string $currencyExchange)
    {
        $this->id = $id;
        $this->name = $name;
        $this->currencyCode = $currencyCode;
        $this->currencyExchange = $currencyExchange;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function changeCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }

    public function getCurrencyExchange(): string
    {
        return $this->currencyExchange;
    }

    public function setCurrencyExchange(string $currencyExchange): void
    {
        $this->currencyExchange = $currencyExchange;
    }

    public function jsonSerialize(): string
    {
        return json_encode(
            [
                'name' => $this->name,
                'symbol' => $this->currencyCode,
                'currency_exchange' => $this->currencyExchange,
            ]
        );
    }
}
