<?php

namespace App\Factory;

use App\Config\UsersRole;
use App\Config\UsersStatus;
use App\Entity\Users;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Users>
 */
final class UsersFactory extends PersistentProxyObjectFactory
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
        return Users::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'email' => self::faker()->text(255),
            'email_verif' => self::faker()->boolean(),
            'first_name' => self::faker()->text(50),
            'login_date' => self::faker()->dateTime(),
            'name' => self::faker()->text(50),
            'password' => self::faker()->text(50),
            'phone' => self::faker()->randomNumber(),
            'register_date' => self::faker()->dateTime(),
            'role' => self::faker()->randomElement(UsersRole::cases()),
            'status' => self::faker()->randomElement(UsersStatus::cases()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Users $users): void {})
        ;
    }
}
