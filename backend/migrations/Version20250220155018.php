<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220155018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shop ADD fiche_shop_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA255179F07 FOREIGN KEY (fiche_shop_id) REFERENCES fiche_shop (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC6A4CA255179F07 ON shop (fiche_shop_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA255179F07');
        $this->addSql('DROP INDEX UNIQ_AC6A4CA255179F07 ON shop');
        $this->addSql('ALTER TABLE shop DROP fiche_shop_id');
    }
}
