<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226214326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member ADD mentor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78DB403044 FOREIGN KEY (mentor_id) REFERENCES `member` (id)');
        $this->addSql('CREATE INDEX IDX_70E4FA78DB403044 ON member (mentor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `member` DROP FOREIGN KEY FK_70E4FA78DB403044');
        $this->addSql('DROP INDEX IDX_70E4FA78DB403044 ON `member`');
        $this->addSql('ALTER TABLE `member` DROP mentor_id');
    }
}
