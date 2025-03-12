<?php

namespace App\Factory;

use App\Entity\GiftCode;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<GiftCode>
 */
final class GiftCodeFactory extends PersistentProxyObjectFactory
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
        return GiftCode::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'code' => self::faker()->text(50),
            'creation_date' => self::faker()->dateTime(),
            'discount' => self::faker()->randomNumber(),
            'expiration_date' => self::faker()->dateTime(),
            'shopId' => ShopFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(GiftCode $giftCode): void {})
        ;
    }
}
