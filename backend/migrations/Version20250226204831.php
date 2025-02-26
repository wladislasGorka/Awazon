<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226204831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_member (event_id INT NOT NULL, member_id INT NOT NULL, INDEX IDX_427D8D2A71F7E88B (event_id), INDEX IDX_427D8D2A7597D3FE (member_id), PRIMARY KEY(event_id, member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_member ADD CONSTRAINT FK_427D8D2A71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_member ADD CONSTRAINT FK_427D8D2A7597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD shop_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA74D16C4DD ON event (shop_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_member DROP FOREIGN KEY FK_427D8D2A71F7E88B');
        $this->addSql('ALTER TABLE event_member DROP FOREIGN KEY FK_427D8D2A7597D3FE');
        $this->addSql('DROP TABLE event_member');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74D16C4DD');
        $this->addSql('DROP INDEX IDX_3BAE0AA74D16C4DD ON event');
        $this->addSql('ALTER TABLE event DROP shop_id');
    }
}
