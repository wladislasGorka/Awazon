<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250228103204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member CHANGE img_profil img_profil VARCHAR(255) NOT NULL, CHANGE paypal_account paypal_account VARCHAR(255) NOT NULL, CHANGE paypal_id paypal_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE shop DROP INDEX UNIQ_AC6A4CA2E8D74410, ADD INDEX IDX_AC6A4CA2E8D74410 (merchant_id_id)');
        $this->addSql('ALTER TABLE shop CHANGE phone phone VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE phone phone INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `member` CHANGE img_profil img_profil VARCHAR(255) DEFAULT NULL, CHANGE paypal_account paypal_account VARCHAR(255) DEFAULT NULL, CHANGE paypal_id paypal_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE shop DROP INDEX IDX_AC6A4CA2E8D74410, ADD UNIQUE INDEX UNIQ_AC6A4CA2E8D74410 (merchant_id_id)');
        $this->addSql('ALTER TABLE shop CHANGE phone phone INT NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE phone phone INT DEFAULT NULL');
    }
}
