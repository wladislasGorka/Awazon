<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220163901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_shop ADD shop_id INT NOT NULL');
        $this->addSql('ALTER TABLE image_shop ADD CONSTRAINT FK_5E50A63C4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('CREATE INDEX IDX_5E50A63C4D16C4DD ON image_shop (shop_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_shop DROP FOREIGN KEY FK_5E50A63C4D16C4DD');
        $this->addSql('DROP INDEX IDX_5E50A63C4D16C4DD ON image_shop');
        $this->addSql('ALTER TABLE image_shop DROP shop_id');
    }
}
