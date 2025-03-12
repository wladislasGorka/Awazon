<?php

namespace App\Factory;

use App\Config\StatutReviewShop;
use App\Entity\ReviewShop;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<ReviewShop>
 */
final class ReviewShopFactory extends PersistentProxyObjectFactory
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
        return ReviewShop::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'comments' => self::faker()->text(),
            'date' => self::faker()->dateTime(),
            'member' => MemberFactory::new(),
            'note' => self::faker()->randomFloat(),
            'shop' => ShopFactory::new(),
            'statut' => self::faker()->randomElement(StatutReviewShop::cases()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(ReviewShop $reviewShop): void {})
        ;
    }
}
