<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250225093307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD shop_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADB852C405 FOREIGN KEY (shop_id_id) REFERENCES shop (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADB852C405 ON product (shop_id_id)');
        $this->addSql('ALTER TABLE shop ADD merchant_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA2E8D74410 FOREIGN KEY (merchant_id_id) REFERENCES merchant (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC6A4CA2E8D74410 ON shop (merchant_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADB852C405');
        $this->addSql('DROP INDEX IDX_D34A04ADB852C405 ON product');
        $this->addSql('ALTER TABLE product DROP shop_id_id');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA2E8D74410');
        $this->addSql('DROP INDEX UNIQ_AC6A4CA2E8D74410 ON shop');
        $this->addSql('ALTER TABLE shop DROP merchant_id_id');
    }
}
