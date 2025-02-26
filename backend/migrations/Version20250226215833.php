<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226215833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event CHANGE city city_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA78BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA78BAC62AF ON event (city_id)');
        $this->addSql('ALTER TABLE member ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA788BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_70E4FA788BAC62AF ON member (city_id)');
        $this->addSql('ALTER TABLE merchant ADD city_id INT NOT NULL');
        $this->addSql('ALTER TABLE merchant ADD CONSTRAINT FK_74AB25E18BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_74AB25E18BAC62AF ON merchant (city_id)');
        $this->addSql('ALTER TABLE `order` ADD city_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993988BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_F52993988BAC62AF ON `order` (city_id)');
        $this->addSql('ALTER TABLE shop ADD city_id INT NOT NULL');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA28BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_AC6A4CA28BAC62AF ON shop (city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA78BAC62AF');
        $this->addSql('DROP INDEX IDX_3BAE0AA78BAC62AF ON event');
        $this->addSql('ALTER TABLE event CHANGE city_id city INT NOT NULL');
        $this->addSql('ALTER TABLE `member` DROP FOREIGN KEY FK_70E4FA788BAC62AF');
        $this->addSql('DROP INDEX IDX_70E4FA788BAC62AF ON `member`');
        $this->addSql('ALTER TABLE `member` DROP city_id');
        $this->addSql('ALTER TABLE merchant DROP FOREIGN KEY FK_74AB25E18BAC62AF');
        $this->addSql('DROP INDEX IDX_74AB25E18BAC62AF ON merchant');
        $this->addSql('ALTER TABLE merchant DROP city_id');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993988BAC62AF');
        $this->addSql('DROP INDEX IDX_F52993988BAC62AF ON `order`');
        $this->addSql('ALTER TABLE `order` DROP city_id');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA28BAC62AF');
        $this->addSql('DROP INDEX IDX_AC6A4CA28BAC62AF ON shop');
        $this->addSql('ALTER TABLE shop DROP city_id');
    }
}
