<?php

namespace App\Factory;

use App\Config\TypeShop;
use App\Entity\Shop;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Shop>
 */
final class ShopFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Shop::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'address' => self::faker()->text(255),
            'city' => CityFactory::new(),
            'creation_date' => self::faker()->dateTime(),
            'latitude' => self::faker()->randomFloat(),
            'logo' => self::faker()->text(255),
            'longitude' => self::faker()->randomFloat(),
            'merchantId' => MerchantFactory::new(),
            'name' => self::faker()->text(255),
            'open_date' => self::faker()->dateTime(),
            'paypal_account' => self::faker()->text(255),
            'paypal_id' => self::faker()->text(255),
            'phone' => self::faker()->randomNumber(),
            'siret' => self::faker()->randomNumber(),
            'status' => self::faker()->text(50),
            'type' => self::faker()->randomElement(TypeShop::cases()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Shop $shop): void {})
        ;
    }
}
