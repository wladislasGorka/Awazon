<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226083123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE member_review_product (member_id INT NOT NULL, review_product_id INT NOT NULL, INDEX IDX_AC4969E97597D3FE (member_id), INDEX IDX_AC4969E93214A757 (review_product_id), PRIMARY KEY(member_id, review_product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_review_shop (member_id INT NOT NULL, review_shop_id INT NOT NULL, INDEX IDX_97E315787597D3FE (member_id), INDEX IDX_97E31578D6F8702A (review_shop_id), PRIMARY KEY(member_id, review_shop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE member_review_product ADD CONSTRAINT FK_AC4969E97597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_review_product ADD CONSTRAINT FK_AC4969E93214A757 FOREIGN KEY (review_product_id) REFERENCES review_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_review_shop ADD CONSTRAINT FK_97E315787597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_review_shop ADD CONSTRAINT FK_97E31578D6F8702A FOREIGN KEY (review_shop_id) REFERENCES review_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category ADD sub_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1F7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1F7BFE87C ON category (sub_category_id)');
        $this->addSql('ALTER TABLE keyword ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE keyword ADD CONSTRAINT FK_5A93713B4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_5A93713B4584665A ON keyword (product_id)');
        $this->addSql('ALTER TABLE loyalty_card ADD levelid_id INT NOT NULL');
        $this->addSql('ALTER TABLE loyalty_card ADD CONSTRAINT FK_EAB8BCBD4B44155D FOREIGN KEY (levelid_id) REFERENCES level (id)');
        $this->addSql('CREATE INDEX IDX_EAB8BCBD4B44155D ON loyalty_card (levelid_id)');
        $this->addSql('ALTER TABLE `option` ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B04584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_5A8600B04584665A ON `option` (product_id)');
        $this->addSql('ALTER TABLE product_image ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F034584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_64617F034584665A ON product_image (product_id)');
        $this->addSql('ALTER TABLE product_info ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_info ADD CONSTRAINT FK_466113F64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_466113F64584665A ON product_info (product_id)');
        $this->addSql('ALTER TABLE sales_image ADD sales_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sales_image ADD CONSTRAINT FK_3379B5E9A4522A07 FOREIGN KEY (sales_id) REFERENCES `sales` (id)');
        $this->addSql('CREATE INDEX IDX_3379B5E9A4522A07 ON sales_image (sales_id)');
        $this->addSql('ALTER TABLE sales_target ADD sales_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sales_target ADD CONSTRAINT FK_649B7DF4A4522A07 FOREIGN KEY (sales_id) REFERENCES `sales` (id)');
        $this->addSql('CREATE INDEX IDX_649B7DF4A4522A07 ON sales_target (sales_id)');
        $this->addSql('ALTER TABLE sub_category ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F7984584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_BCE3F7984584665A ON sub_category (product_id)');
        $this->addSql('ALTER TABLE value ADD option_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE value ADD CONSTRAINT FK_1D77583446AF233F FOREIGN KEY (option_id_id) REFERENCES `option` (id)');
        $this->addSql('CREATE INDEX IDX_1D77583446AF233F ON value (option_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member_review_product DROP FOREIGN KEY FK_AC4969E97597D3FE');
        $this->addSql('ALTER TABLE member_review_product DROP FOREIGN KEY FK_AC4969E93214A757');
        $this->addSql('ALTER TABLE member_review_shop DROP FOREIGN KEY FK_97E315787597D3FE');
        $this->addSql('ALTER TABLE member_review_shop DROP FOREIGN KEY FK_97E31578D6F8702A');
        $this->addSql('DROP TABLE member_review_product');
        $this->addSql('DROP TABLE member_review_shop');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1F7BFE87C');
        $this->addSql('DROP INDEX IDX_64C19C1F7BFE87C ON category');
        $this->addSql('ALTER TABLE category DROP sub_category_id');
        $this->addSql('ALTER TABLE keyword DROP FOREIGN KEY FK_5A93713B4584665A');
        $this->addSql('DROP INDEX IDX_5A93713B4584665A ON keyword');
        $this->addSql('ALTER TABLE keyword DROP product_id');
        $this->addSql('ALTER TABLE loyalty_card DROP FOREIGN KEY FK_EAB8BCBD4B44155D');
        $this->addSql('DROP INDEX IDX_EAB8BCBD4B44155D ON loyalty_card');
        $this->addSql('ALTER TABLE loyalty_card DROP levelid_id');
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B04584665A');
        $this->addSql('DROP INDEX IDX_5A8600B04584665A ON `option`');
        $this->addSql('ALTER TABLE `option` DROP product_id');
        $this->addSql('ALTER TABLE product_image DROP FOREIGN KEY FK_64617F034584665A');
        $this->addSql('DROP INDEX IDX_64617F034584665A ON product_image');
        $this->addSql('ALTER TABLE product_image DROP product_id');
        $this->addSql('ALTER TABLE product_info DROP FOREIGN KEY FK_466113F64584665A');
        $this->addSql('DROP INDEX IDX_466113F64584665A ON product_info');
        $this->addSql('ALTER TABLE product_info DROP product_id');
        $this->addSql('ALTER TABLE sales_image DROP FOREIGN KEY FK_3379B5E9A4522A07');
        $this->addSql('DROP INDEX IDX_3379B5E9A4522A07 ON sales_image');
        $this->addSql('ALTER TABLE sales_image DROP sales_id');
        $this->addSql('ALTER TABLE sales_target DROP FOREIGN KEY FK_649B7DF4A4522A07');
        $this->addSql('DROP INDEX IDX_649B7DF4A4522A07 ON sales_target');
        $this->addSql('ALTER TABLE sales_target DROP sales_id');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F7984584665A');
        $this->addSql('DROP INDEX IDX_BCE3F7984584665A ON sub_category');
        $this->addSql('ALTER TABLE sub_category DROP product_id');
        $this->addSql('ALTER TABLE value DROP FOREIGN KEY FK_1D77583446AF233F');
        $this->addSql('DROP INDEX IDX_1D77583446AF233F ON value');
        $this->addSql('ALTER TABLE value DROP option_id_id');
    }
}
