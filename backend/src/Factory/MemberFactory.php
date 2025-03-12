<?php

namespace App\Factory;

use App\Config\UsersRole;
use App\Config\UsersStatus;
use App\Entity\Member;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Member>
 */
final class MemberFactory extends PersistentProxyObjectFactory
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
        return Member::class;
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
            'img_profil' => self::faker()->text(255),
            'login_date' => self::faker()->dateTime(),
            'name' => self::faker()->text(50),
            'password' => self::faker()->text(50),
            'paypal_account' => self::faker()->text(255),
            'paypal_id' => self::faker()->text(255),
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
            // ->afterInstantiate(function(Member $member): void {})
        ;
    }
}
