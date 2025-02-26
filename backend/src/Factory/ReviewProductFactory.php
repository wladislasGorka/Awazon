<?php

namespace App\Factory;

use App\Config\StatutReviewProduct;
use App\Entity\ReviewProduct;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<ReviewProduct>
 */
final class ReviewProductFactory extends PersistentProxyObjectFactory
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
        return ReviewProduct::class;
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
            'product' => ProductFactory::new(),
            'statut' => self::faker()->randomElement(StatutReviewProduct::cases()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(ReviewProduct $reviewProduct): void {})
        ;
    }
}
