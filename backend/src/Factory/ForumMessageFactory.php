<?php

namespace App\Factory;

use App\Config\ForumMessageStatus;
use App\Entity\ForumMessage;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<ForumMessage>
 */
final class ForumMessageFactory extends PersistentProxyObjectFactory
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
        return ForumMessage::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'date_creation' => self::faker()->dateTime(),
            'date_edit' => self::faker()->dateTime(),
            'forumSubject' => ForumSubjectFactory::new(),
            'message' => self::faker()->text(),
            'message_status' => self::faker()->randomElement(ForumMessageStatus::cases()),
            'user' => UsersFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(ForumMessage $forumMessage): void {})
        ;
    }
}
