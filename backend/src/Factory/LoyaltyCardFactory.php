<?php

namespace App\Factory;

use App\Entity\LoyaltyCard;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<LoyaltyCard>
 */
final class LoyaltyCardFactory extends PersistentProxyObjectFactory
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
        return LoyaltyCard::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'cumul_point' => self::faker()->randomNumber(),
            'level' => self::faker()->text(50),
            'levelid' => LevelFactory::new(),
            'member' => MemberFactory::new(),
            'points' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(LoyaltyCard $loyaltyCard): void {})
        ;
    }
}
