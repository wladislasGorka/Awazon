<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220165821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shop_category_shop (shop_id INT NOT NULL, category_shop_id INT NOT NULL, INDEX IDX_39EDA1EA4D16C4DD (shop_id), INDEX IDX_39EDA1EA8ACE84A3 (category_shop_id), PRIMARY KEY(shop_id, category_shop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shop_category_shop ADD CONSTRAINT FK_39EDA1EA4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shop_category_shop ADD CONSTRAINT FK_39EDA1EA8ACE84A3 FOREIGN KEY (category_shop_id) REFERENCES category_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shop CHANGE type type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shop_category_shop DROP FOREIGN KEY FK_39EDA1EA4D16C4DD');
        $this->addSql('ALTER TABLE shop_category_shop DROP FOREIGN KEY FK_39EDA1EA8ACE84A3');
        $this->addSql('DROP TABLE shop_category_shop');
        $this->addSql('ALTER TABLE shop CHANGE type type VARCHAR(50) NOT NULL');
    }
}
