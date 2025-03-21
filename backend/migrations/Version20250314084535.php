<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250314084535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shop_category_shop (shop_id INT NOT NULL, category_shop_id INT NOT NULL, INDEX IDX_39EDA1EA4D16C4DD (shop_id), INDEX IDX_39EDA1EA8ACE84A3 (category_shop_id), PRIMARY KEY(shop_id, category_shop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_BCE3F79812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE super_admin (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, recipient_id INT DEFAULT NULL, service_ticket VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_97A0ADA3F624B39D (sender_id), INDEX IDX_97A0ADA3E92F8F78 (recipient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, register_date DATETIME NOT NULL, login_date DATETIME NOT NULL, email_verif TINYINT(1) NOT NULL, status VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, roles LONGTEXT DEFAULT NULL, class VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE value (id INT AUTO_INCREMENT NOT NULL, option_id_id INT NOT NULL, name VARCHAR(50) NOT NULL, stock VARCHAR(50) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_1D77583446AF233F (option_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shop_category_shop ADD CONSTRAINT FK_39EDA1EA4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shop_category_shop ADD CONSTRAINT FK_39EDA1EA8ACE84A3 FOREIGN KEY (category_shop_id) REFERENCES category_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F79812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE super_admin ADD CONSTRAINT FK_BC8C2783BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3F624B39D FOREIGN KEY (sender_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3E92F8F78 FOREIGN KEY (recipient_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE value ADD CONSTRAINT FK_1D77583446AF233F FOREIGN KEY (option_id_id) REFERENCES `option` (id)');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D917597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D9171F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B77597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA78BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0E800861C2 FOREIGN KEY (forum_subject_id) REFERENCES forum_subject (id)');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE forum_subject ADD CONSTRAINT FK_A02730B5A155E3F FOREIGN KEY (forum_section_id) REFERENCES forum_section (id)');
        $this->addSql('ALTER TABLE forum_subject ADD CONSTRAINT FK_A02730BA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE gift_code ADD CONSTRAINT FK_8568C2C54D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE gift_code_target ADD CONSTRAINT FK_E9CBD694B80CDB8 FOREIGN KEY (gift_code_id) REFERENCES gift_code (id)');
        $this->addSql('ALTER TABLE image_shop ADD CONSTRAINT FK_5E50A63C4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE info_fiche_shop ADD CONSTRAINT FK_1E1FE78555179F07 FOREIGN KEY (fiche_shop_id) REFERENCES fiche_shop (id)');
        $this->addSql('ALTER TABLE keyword ADD CONSTRAINT FK_5A93713B4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE loyalty_card ADD CONSTRAINT FK_EAB8BCBD4B44155D FOREIGN KEY (levelid_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE loyalty_card ADD CONSTRAINT FK_EAB8BCBD7597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE `member` ADD CONSTRAINT FK_70E4FA78DB403044 FOREIGN KEY (mentor_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE `member` ADD CONSTRAINT FK_70E4FA788BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE `member` ADD CONSTRAINT FK_70E4FA78BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_shop ADD CONSTRAINT FK_50E260FE7597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_shop ADD CONSTRAINT FK_50E260FE4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_product ADD CONSTRAINT FK_6CBEB3397597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_product ADD CONSTRAINT FK_6CBEB3394584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE merchant ADD CONSTRAINT FK_74AB25E18BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE merchant ADD CONSTRAINT FK_74AB25E1BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B04584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984B80CDB8 FOREIGN KEY (gift_code_id) REFERENCES gift_code (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981D650BA4 FOREIGN KEY (member_id_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993988BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_shop ADD CONSTRAINT FK_E19B76B54D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE order_shop ADD CONSTRAINT FK_E19B76B5FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F034584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_info ADD CONSTRAINT FK_466113F64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE qna ADD CONSTRAINT FK_6BB9CC9268106FEE FOREIGN KEY (sender_admin_id) REFERENCES `admin` (id)');
        $this->addSql('ALTER TABLE qna ADD CONSTRAINT FK_6BB9CC926A15E0F8 FOREIGN KEY (sender_super_admin_id) REFERENCES super_admin (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849551D650BA4 FOREIGN KEY (member_id_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B852C405 FOREIGN KEY (shop_id_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE review_product ADD CONSTRAINT FK_48A4B05A7597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE review_product ADD CONSTRAINT FK_48A4B05A4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE review_shop ADD CONSTRAINT FK_4EDE01BA7597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE review_shop ADD CONSTRAINT FK_4EDE01BA4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT FK_6B8170444D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE sales_image ADD CONSTRAINT FK_3379B5E9A4522A07 FOREIGN KEY (sales_id) REFERENCES `sales` (id)');
        $this->addSql('ALTER TABLE sales_target ADD CONSTRAINT FK_649B7DF4A4522A07 FOREIGN KEY (sales_id) REFERENCES `sales` (id)');
        $this->addSql('ALTER TABLE shop ADD fiche_shop_id INT DEFAULT NULL, ADD merchant_id_id INT NOT NULL, ADD city_id INT NOT NULL, ADD logo VARCHAR(255) DEFAULT NULL, ADD siret INT NOT NULL, ADD longitude DOUBLE PRECISION DEFAULT NULL, ADD latitude DOUBLE PRECISION DEFAULT NULL, ADD open_date DATETIME DEFAULT NULL, ADD creation_date DATETIME NOT NULL, ADD status VARCHAR(50) NOT NULL, ADD paypal_account VARCHAR(255) DEFAULT NULL, ADD paypal_id VARCHAR(255) DEFAULT NULL, ADD type VARCHAR(255) NOT NULL, CHANGE phone phone VARCHAR(20) NOT NULL, CHANGE adress address VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA255179F07 FOREIGN KEY (fiche_shop_id) REFERENCES fiche_shop (id)');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA2E8D74410 FOREIGN KEY (merchant_id_id) REFERENCES merchant (id)');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA28BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC6A4CA255179F07 ON shop (fiche_shop_id)');
        $this->addSql('CREATE INDEX IDX_AC6A4CA2E8D74410 ON shop (merchant_id_id)');
        $this->addSql('CREATE INDEX IDX_AC6A4CA28BAC62AF ON shop (city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADF7BFE87C');
        $this->addSql('ALTER TABLE qna DROP FOREIGN KEY FK_6BB9CC926A15E0F8');
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE forum_message DROP FOREIGN KEY FK_47717D0EA76ED395');
        $this->addSql('ALTER TABLE forum_subject DROP FOREIGN KEY FK_A02730BA76ED395');
        $this->addSql('ALTER TABLE `member` DROP FOREIGN KEY FK_70E4FA78BF396750');
        $this->addSql('ALTER TABLE merchant DROP FOREIGN KEY FK_74AB25E1BF396750');
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C8A76ED395');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784A76ED395');
        $this->addSql('ALTER TABLE shop_category_shop DROP FOREIGN KEY FK_39EDA1EA4D16C4DD');
        $this->addSql('ALTER TABLE shop_category_shop DROP FOREIGN KEY FK_39EDA1EA8ACE84A3');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F79812469DE2');
        $this->addSql('ALTER TABLE super_admin DROP FOREIGN KEY FK_BC8C2783BF396750');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3F624B39D');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3E92F8F78');
        $this->addSql('ALTER TABLE value DROP FOREIGN KEY FK_1D77583446AF233F');
        $this->addSql('DROP TABLE shop_category_shop');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('DROP TABLE super_admin');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE value');
        $this->addSql('ALTER TABLE attendance DROP FOREIGN KEY FK_6DE30D917597D3FE');
        $this->addSql('ALTER TABLE attendance DROP FOREIGN KEY FK_6DE30D9171F7E88B');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74584665A');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B77597D3FE');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74D16C4DD');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA78BAC62AF');
        $this->addSql('ALTER TABLE forum_message DROP FOREIGN KEY FK_47717D0E800861C2');
        $this->addSql('ALTER TABLE forum_subject DROP FOREIGN KEY FK_A02730B5A155E3F');
        $this->addSql('ALTER TABLE gift_code DROP FOREIGN KEY FK_8568C2C54D16C4DD');
        $this->addSql('ALTER TABLE gift_code_target DROP FOREIGN KEY FK_E9CBD694B80CDB8');
        $this->addSql('ALTER TABLE image_shop DROP FOREIGN KEY FK_5E50A63C4D16C4DD');
        $this->addSql('ALTER TABLE info_fiche_shop DROP FOREIGN KEY FK_1E1FE78555179F07');
        $this->addSql('ALTER TABLE keyword DROP FOREIGN KEY FK_5A93713B4584665A');
        $this->addSql('ALTER TABLE loyalty_card DROP FOREIGN KEY FK_EAB8BCBD4B44155D');
        $this->addSql('ALTER TABLE loyalty_card DROP FOREIGN KEY FK_EAB8BCBD7597D3FE');
        $this->addSql('ALTER TABLE `member` DROP FOREIGN KEY FK_70E4FA78DB403044');
        $this->addSql('ALTER TABLE `member` DROP FOREIGN KEY FK_70E4FA788BAC62AF');
        $this->addSql('ALTER TABLE member_product DROP FOREIGN KEY FK_6CBEB3397597D3FE');
        $this->addSql('ALTER TABLE member_product DROP FOREIGN KEY FK_6CBEB3394584665A');
        $this->addSql('ALTER TABLE member_shop DROP FOREIGN KEY FK_50E260FE7597D3FE');
        $this->addSql('ALTER TABLE member_shop DROP FOREIGN KEY FK_50E260FE4D16C4DD');
        $this->addSql('ALTER TABLE merchant DROP FOREIGN KEY FK_74AB25E18BAC62AF');
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B04584665A');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984B80CDB8');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981D650BA4');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993988BAC62AF');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6FCDAEAAA');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE order_shop DROP FOREIGN KEY FK_E19B76B54D16C4DD');
        $this->addSql('ALTER TABLE order_shop DROP FOREIGN KEY FK_E19B76B5FCDAEAAA');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4D16C4DD');
        $this->addSql('ALTER TABLE product_image DROP FOREIGN KEY FK_64617F034584665A');
        $this->addSql('ALTER TABLE product_info DROP FOREIGN KEY FK_466113F64584665A');
        $this->addSql('ALTER TABLE qna DROP FOREIGN KEY FK_6BB9CC9268106FEE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849551D650BA4');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B852C405');
        $this->addSql('ALTER TABLE review_product DROP FOREIGN KEY FK_48A4B05A7597D3FE');
        $this->addSql('ALTER TABLE review_product DROP FOREIGN KEY FK_48A4B05A4584665A');
        $this->addSql('ALTER TABLE review_shop DROP FOREIGN KEY FK_4EDE01BA7597D3FE');
        $this->addSql('ALTER TABLE review_shop DROP FOREIGN KEY FK_4EDE01BA4D16C4DD');
        $this->addSql('ALTER TABLE `sales` DROP FOREIGN KEY FK_6B8170444D16C4DD');
        $this->addSql('ALTER TABLE sales_image DROP FOREIGN KEY FK_3379B5E9A4522A07');
        $this->addSql('ALTER TABLE sales_target DROP FOREIGN KEY FK_649B7DF4A4522A07');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA255179F07');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA2E8D74410');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA28BAC62AF');
        $this->addSql('DROP INDEX UNIQ_AC6A4CA255179F07 ON shop');
        $this->addSql('DROP INDEX IDX_AC6A4CA2E8D74410 ON shop');
        $this->addSql('DROP INDEX IDX_AC6A4CA28BAC62AF ON shop');
        $this->addSql('ALTER TABLE shop ADD adress VARCHAR(255) NOT NULL, DROP fiche_shop_id, DROP merchant_id_id, DROP city_id, DROP logo, DROP siret, DROP address, DROP longitude, DROP latitude, DROP open_date, DROP creation_date, DROP status, DROP paypal_account, DROP paypal_id, DROP type, CHANGE phone phone INT NOT NULL');
    }
}
