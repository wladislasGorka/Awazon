<?php

namespace App\Factory;

use App\Config\GiftCodeTargetType;
use App\Entity\GiftCodeTarget;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<GiftCodeTarget>
 */
final class GiftCodeTargetFactory extends PersistentProxyObjectFactory
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
        return GiftCodeTarget::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'giftCode' => GiftCodeFactory::new(),
            'target_id' => self::faker()->randomNumber(),
            'type' => self::faker()->randomElement(GiftCodeTargetType::cases()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(GiftCodeTarget $giftCodeTarget): void {})
        ;
    }
}
