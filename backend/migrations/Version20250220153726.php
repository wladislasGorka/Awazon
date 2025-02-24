<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220153726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_fiche_shop ADD fiche_shop_id INT NOT NULL');
        $this->addSql('ALTER TABLE info_fiche_shop ADD CONSTRAINT FK_1E1FE78555179F07 FOREIGN KEY (fiche_shop_id) REFERENCES fiche_shop (id)');
        $this->addSql('CREATE INDEX IDX_1E1FE78555179F07 ON info_fiche_shop (fiche_shop_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_fiche_shop DROP FOREIGN KEY FK_1E1FE78555179F07');
        $this->addSql('DROP INDEX IDX_1E1FE78555179F07 ON info_fiche_shop');
        $this->addSql('ALTER TABLE info_fiche_shop DROP fiche_shop_id');
    }
}
