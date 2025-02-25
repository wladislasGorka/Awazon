<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250225085525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gift_code ADD shop_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE gift_code ADD CONSTRAINT FK_8568C2C5B852C405 FOREIGN KEY (shop_id_id) REFERENCES shop (id)');
        $this->addSql('CREATE INDEX IDX_8568C2C5B852C405 ON gift_code (shop_id_id)');
        $this->addSql('ALTER TABLE `order` ADD gift_code_id INT DEFAULT NULL, ADD member_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984B80CDB8 FOREIGN KEY (gift_code_id) REFERENCES gift_code (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981D650BA4 FOREIGN KEY (member_id_id) REFERENCES `member` (id)');
        $this->addSql('CREATE INDEX IDX_F52993984B80CDB8 ON `order` (gift_code_id)');
        $this->addSql('CREATE INDEX IDX_F52993981D650BA4 ON `order` (member_id_id)');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE order_product ADD order_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6FCDAEAAA ON order_product (order_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gift_code DROP FOREIGN KEY FK_8568C2C5B852C405');
        $this->addSql('DROP INDEX IDX_8568C2C5B852C405 ON gift_code');
        $this->addSql('ALTER TABLE gift_code DROP shop_id_id');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984B80CDB8');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981D650BA4');
        $this->addSql('DROP INDEX IDX_F52993984B80CDB8 ON `order`');
        $this->addSql('DROP INDEX IDX_F52993981D650BA4 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP gift_code_id, DROP member_id_id');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6FCDAEAAA');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('DROP INDEX IDX_2530ADE6FCDAEAAA ON order_product');
        $this->addSql('ALTER TABLE order_product DROP order_id_id');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES `order` (id)');
    }
}
