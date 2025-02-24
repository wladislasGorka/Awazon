<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250224193048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attendance (id INT AUTO_INCREMENT NOT NULL, register_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, add_time DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_shop (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, city_name VARCHAR(255) NOT NULL, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, address VARCHAR(255) NOT NULL, city INT NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, path_image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_shop (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_message (id INT AUTO_INCREMENT NOT NULL, message LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, date_edit DATETIME NOT NULL, message_status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_section (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, access VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_subject (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gift_code (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, discount INT NOT NULL, creation_date DATETIME NOT NULL, expiration_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gift_code_target (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, target_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_shop (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, path VARCHAR(50) NOT NULL, INDEX IDX_5E50A63C4D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info_fiche_shop (id INT AUTO_INCREMENT NOT NULL, fiche_shop_id INT NOT NULL, name VARCHAR(50) NOT NULL, value VARCHAR(255) NOT NULL, icon VARCHAR(50) DEFAULT NULL, INDEX IDX_1E1FE78555179F07 (fiche_shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE keyword (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loyalty_card (id INT AUTO_INCREMENT NOT NULL, points INT NOT NULL, cumul_point INT NOT NULL, level VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `member` (id INT AUTO_INCREMENT NOT NULL, img_profil VARCHAR(255) NOT NULL, paypal_account VARCHAR(255) NOT NULL, paypal_id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE merchant (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, kbis VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, creation_date DATETIME NOT NULL, release_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, creation_date DATETIME NOT NULL, pickup_date DATETIME DEFAULT NULL, address_bill VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, quantity INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_2530ADE64584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_shop (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, order_id_id INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_E19B76B54D16C4DD (shop_id), INDEX IDX_E19B76B5FCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, stock VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_info (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, value VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qna (id INT AUTO_INCREMENT NOT NULL, question LONGTEXT NOT NULL, answer LONGTEXT NOT NULL, creation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, target INT NOT NULL, status VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, mail VARCHAR(50) NOT NULL, date DATE NOT NULL, time TIME NOT NULL, seats INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review_product (id INT AUTO_INCREMENT NOT NULL, note DOUBLE PRECISION DEFAULT NULL, comments LONGTEXT DEFAULT NULL, date DATETIME DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review_shop (id INT AUTO_INCREMENT NOT NULL, note DOUBLE PRECISION DEFAULT NULL, comments LONGTEXT DEFAULT NULL, date DATETIME DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales (id INT AUTO_INCREMENT NOT NULL, slogan VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, pourcent VARCHAR(10) NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales_image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales_target (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop (id INT AUTO_INCREMENT NOT NULL, fiche_shop_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, siret INT NOT NULL, address VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, phone INT NOT NULL, open_date DATETIME DEFAULT NULL, creation_date DATETIME NOT NULL, status VARCHAR(50) NOT NULL, paypal_account VARCHAR(255) DEFAULT NULL, paypal_id VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AC6A4CA255179F07 (fiche_shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop_category_shop (shop_id INT NOT NULL, category_shop_id INT NOT NULL, INDEX IDX_39EDA1EA4D16C4DD (shop_id), INDEX IDX_39EDA1EA8ACE84A3 (category_shop_id), PRIMARY KEY(shop_id, category_shop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE super_admin (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, service_ticket VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(50) NOT NULL, phone INT NOT NULL, register_date DATETIME NOT NULL, login_date DATETIME NOT NULL, email_verif TINYINT(1) NOT NULL, status VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE value (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, stock VARCHAR(50) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_shop ADD CONSTRAINT FK_5E50A63C4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE info_fiche_shop ADD CONSTRAINT FK_1E1FE78555179F07 FOREIGN KEY (fiche_shop_id) REFERENCES fiche_shop (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_shop ADD CONSTRAINT FK_E19B76B54D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE order_shop ADD CONSTRAINT FK_E19B76B5FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA255179F07 FOREIGN KEY (fiche_shop_id) REFERENCES fiche_shop (id)');
        $this->addSql('ALTER TABLE shop_category_shop ADD CONSTRAINT FK_39EDA1EA4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shop_category_shop ADD CONSTRAINT FK_39EDA1EA8ACE84A3 FOREIGN KEY (category_shop_id) REFERENCES category_shop (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_shop DROP FOREIGN KEY FK_5E50A63C4D16C4DD');
        $this->addSql('ALTER TABLE info_fiche_shop DROP FOREIGN KEY FK_1E1FE78555179F07');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE order_shop DROP FOREIGN KEY FK_E19B76B54D16C4DD');
        $this->addSql('ALTER TABLE order_shop DROP FOREIGN KEY FK_E19B76B5FCDAEAAA');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA255179F07');
        $this->addSql('ALTER TABLE shop_category_shop DROP FOREIGN KEY FK_39EDA1EA4D16C4DD');
        $this->addSql('ALTER TABLE shop_category_shop DROP FOREIGN KEY FK_39EDA1EA8ACE84A3');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE attendance');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_shop');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE fiche_shop');
        $this->addSql('DROP TABLE forum_message');
        $this->addSql('DROP TABLE forum_section');
        $this->addSql('DROP TABLE forum_subject');
        $this->addSql('DROP TABLE gift_code');
        $this->addSql('DROP TABLE gift_code_target');
        $this->addSql('DROP TABLE image_shop');
        $this->addSql('DROP TABLE info_fiche_shop');
        $this->addSql('DROP TABLE keyword');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE loyalty_card');
        $this->addSql('DROP TABLE `member`');
        $this->addSql('DROP TABLE merchant');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE order_shop');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_image');
        $this->addSql('DROP TABLE product_info');
        $this->addSql('DROP TABLE qna');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE review_product');
        $this->addSql('DROP TABLE review_shop');
        $this->addSql('DROP TABLE sales');
        $this->addSql('DROP TABLE sales_image');
        $this->addSql('DROP TABLE sales_target');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP TABLE shop_category_shop');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('DROP TABLE super_admin');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE value');
    }
}
