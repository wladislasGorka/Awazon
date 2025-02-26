<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226205512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_member DROP FOREIGN KEY FK_427D8D2A71F7E88B');
        $this->addSql('ALTER TABLE event_member DROP FOREIGN KEY FK_427D8D2A7597D3FE');
        $this->addSql('DROP TABLE event_member');
        $this->addSql('ALTER TABLE attendance ADD member_id INT NOT NULL, ADD event_id INT NOT NULL');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D917597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D9171F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_6DE30D917597D3FE ON attendance (member_id)');
        $this->addSql('CREATE INDEX IDX_6DE30D9171F7E88B ON attendance (event_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_member (event_id INT NOT NULL, member_id INT NOT NULL, INDEX IDX_427D8D2A71F7E88B (event_id), INDEX IDX_427D8D2A7597D3FE (member_id), PRIMARY KEY(event_id, member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event_member ADD CONSTRAINT FK_427D8D2A71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_member ADD CONSTRAINT FK_427D8D2A7597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attendance DROP FOREIGN KEY FK_6DE30D917597D3FE');
        $this->addSql('ALTER TABLE attendance DROP FOREIGN KEY FK_6DE30D9171F7E88B');
        $this->addSql('DROP INDEX IDX_6DE30D917597D3FE ON attendance');
        $this->addSql('DROP INDEX IDX_6DE30D9171F7E88B ON attendance');
        $this->addSql('ALTER TABLE attendance DROP member_id, DROP event_id');
    }
}
