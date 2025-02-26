<?php

namespace App\Factory;

use App\Config\ReportStatus;
use App\Config\ReportType;
use App\Entity\Report;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Report>
 */
final class ReportFactory extends PersistentProxyObjectFactory
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
        return Report::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'date' => self::faker()->dateTime(),
            'status' => self::faker()->randomElement(ReportStatus::cases()),
            'target' => self::faker()->randomNumber(),
            'type' => self::faker()->randomElement(ReportType::cases()),
            'user' => UsersFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Report $report): void {})
        ;
    }
}
