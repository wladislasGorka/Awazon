<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226192633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE loyalty_card ADD member_id INT NOT NULL');
        $this->addSql('ALTER TABLE loyalty_card ADD CONSTRAINT FK_EAB8BCBD7597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EAB8BCBD7597D3FE ON loyalty_card (member_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE loyalty_card DROP FOREIGN KEY FK_EAB8BCBD7597D3FE');
        $this->addSql('DROP INDEX UNIQ_EAB8BCBD7597D3FE ON loyalty_card');
        $this->addSql('ALTER TABLE loyalty_card DROP member_id');
    }
}
