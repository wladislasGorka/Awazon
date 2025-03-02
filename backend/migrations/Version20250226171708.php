<?php
 
declare(strict_types=1);
 
namespace DoctrineMigrations;
 
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
 
/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226171708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }
 
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attendance (id INT AUTO_INCREMENT NOT NULL, register_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, member_id_id INT NOT NULL, product_id_id INT NOT NULL, quantity INT NOT NULL, add_time DATETIME NOT NULL, INDEX IDX_BA388B71D650BA4 (member_id_id), INDEX IDX_BA388B7DE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, sub_category_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_64C19C1F7BFE87C (sub_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_shop (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, city_name VARCHAR(255) NOT NULL, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, address VARCHAR(255) NOT NULL, city INT NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, path_image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_shop (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_message (id INT AUTO_INCREMENT NOT NULL, message LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, date_edit DATETIME NOT NULL, message_status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_section (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, access VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_subject (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gift_code (id INT AUTO_INCREMENT NOT NULL, shop_id_id INT NOT NULL, code VARCHAR(50) NOT NULL, discount INT NOT NULL, creation_date DATETIME NOT NULL, expiration_date DATETIME NOT NULL, INDEX IDX_8568C2C5B852C405 (shop_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gift_code_target (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, target_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_shop (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, path VARCHAR(50) NOT NULL, INDEX IDX_5E50A63C4D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info_fiche_shop (id INT AUTO_INCREMENT NOT NULL, fiche_shop_id INT NOT NULL, name VARCHAR(50) NOT NULL, value VARCHAR(255) NOT NULL, icon VARCHAR(50) DEFAULT NULL, INDEX IDX_1E1FE78555179F07 (fiche_shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE keyword (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5A93713B4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loyalty_card (id INT AUTO_INCREMENT NOT NULL, levelid_id INT NOT NULL, points INT NOT NULL, cumul_point INT NOT NULL, level VARCHAR(50) NOT NULL, INDEX IDX_EAB8BCBD4B44155D (levelid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `member` (id INT NOT NULL, img_profil VARCHAR(255) NOT NULL, paypal_account VARCHAR(255) NOT NULL, paypal_id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_review_product (member_id INT NOT NULL, review_product_id INT NOT NULL, INDEX IDX_AC4969E97597D3FE (member_id), INDEX IDX_AC4969E93214A757 (review_product_id), PRIMARY KEY(member_id, review_product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_review_shop (member_id INT NOT NULL, review_shop_id INT NOT NULL, INDEX IDX_97E315787597D3FE (member_id), INDEX IDX_97E31578D6F8702A (review_shop_id), PRIMARY KEY(member_id, review_shop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE merchant (id INT NOT NULL, address VARCHAR(255) NOT NULL, kbis VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, creation_date DATETIME NOT NULL, release_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_5A8600B04584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, gift_code_id INT DEFAULT NULL, member_id_id INT DEFAULT NULL, number INT NOT NULL, creation_date DATETIME NOT NULL, pickup_date DATETIME DEFAULT NULL, address_bill VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_F52993984B80CDB8 (gift_code_id), INDEX IDX_F52993981D650BA4 (member_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, product_id INT NOT NULL, quantity INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_2530ADE6FCDAEAAA (order_id_id), INDEX IDX_2530ADE64584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_shop (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, order_id_id INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_E19B76B54D16C4DD (shop_id), INDEX IDX_E19B76B5FCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, shop_id_id INT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, stock VARCHAR(50) NOT NULL, INDEX IDX_D34A04ADB852C405 (shop_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_image (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_64617F034584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_info (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, name VARCHAR(50) NOT NULL, value VARCHAR(50) NOT NULL, INDEX IDX_466113F64584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qna (id INT AUTO_INCREMENT NOT NULL, question LONGTEXT NOT NULL, answer LONGTEXT NOT NULL, creation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, target INT NOT NULL, status VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, member_id_id INT DEFAULT NULL, shop_id_id INT NOT NULL, name VARCHAR(50) NOT NULL, mail VARCHAR(50) NOT NULL, date DATE NOT NULL, time TIME NOT NULL, seats INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_42C849551D650BA4 (member_id_id), INDEX IDX_42C84955B852C405 (shop_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review_product (id INT AUTO_INCREMENT NOT NULL, note DOUBLE PRECISION DEFAULT NULL, comments LONGTEXT DEFAULT NULL, date DATETIME DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review_shop (id INT AUTO_INCREMENT NOT NULL, note DOUBLE PRECISION DEFAULT NULL, comments LONGTEXT DEFAULT NULL, date DATETIME DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `sales` (id INT AUTO_INCREMENT NOT NULL, slogan VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, pourcent VARCHAR(10) NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales_image (id INT AUTO_INCREMENT NOT NULL, sales_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_3379B5E9A4522A07 (sales_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales_target (id INT AUTO_INCREMENT NOT NULL, sales_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_649B7DF4A4522A07 (sales_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop (id INT AUTO_INCREMENT NOT NULL, fiche_shop_id INT DEFAULT NULL, merchant_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, siret INT NOT NULL, address VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, phone INT NOT NULL, open_date DATETIME DEFAULT NULL, creation_date DATETIME NOT NULL, status VARCHAR(50) NOT NULL, paypal_account VARCHAR(255) DEFAULT NULL, paypal_id VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AC6A4CA255179F07 (fiche_shop_id), UNIQUE INDEX UNIQ_AC6A4CA2E8D74410 (merchant_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop_category_shop (shop_id INT NOT NULL, category_shop_id INT NOT NULL, INDEX IDX_39EDA1EA4D16C4DD (shop_id), INDEX IDX_39EDA1EA8ACE84A3 (category_shop_id), PRIMARY KEY(shop_id, category_shop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_BCE3F7984584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE super_admin (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, service_ticket VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(50) NOT NULL, phone INT NOT NULL, register_date DATETIME NOT NULL, login_date DATETIME NOT NULL, email_verif TINYINT(1) NOT NULL, status VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE value (id INT AUTO_INCREMENT NOT NULL, option_id_id INT NOT NULL, name VARCHAR(50) NOT NULL, stock VARCHAR(50) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_1D77583446AF233F (option_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B71D650BA4 FOREIGN KEY (member_id_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1F7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('ALTER TABLE gift_code ADD CONSTRAINT FK_8568C2C5B852C405 FOREIGN KEY (shop_id_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE image_shop ADD CONSTRAINT FK_5E50A63C4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE info_fiche_shop ADD CONSTRAINT FK_1E1FE78555179F07 FOREIGN KEY (fiche_shop_id) REFERENCES fiche_shop (id)');
        $this->addSql('ALTER TABLE keyword ADD CONSTRAINT FK_5A93713B4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE loyalty_card ADD CONSTRAINT FK_EAB8BCBD4B44155D FOREIGN KEY (levelid_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE `member` ADD CONSTRAINT FK_70E4FA78BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_review_product ADD CONSTRAINT FK_AC4969E97597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_review_product ADD CONSTRAINT FK_AC4969E93214A757 FOREIGN KEY (review_product_id) REFERENCES review_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_review_shop ADD CONSTRAINT FK_97E315787597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_review_shop ADD CONSTRAINT FK_97E31578D6F8702A FOREIGN KEY (review_shop_id) REFERENCES review_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE merchant ADD CONSTRAINT FK_74AB25E1BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B04584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984B80CDB8 FOREIGN KEY (gift_code_id) REFERENCES gift_code (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981D650BA4 FOREIGN KEY (member_id_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_shop ADD CONSTRAINT FK_E19B76B54D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE order_shop ADD CONSTRAINT FK_E19B76B5FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADB852C405 FOREIGN KEY (shop_id_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F034584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_info ADD CONSTRAINT FK_466113F64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849551D650BA4 FOREIGN KEY (member_id_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B852C405 FOREIGN KEY (shop_id_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE sales_image ADD CONSTRAINT FK_3379B5E9A4522A07 FOREIGN KEY (sales_id) REFERENCES `sales` (id)');
        $this->addSql('ALTER TABLE sales_target ADD CONSTRAINT FK_649B7DF4A4522A07 FOREIGN KEY (sales_id) REFERENCES `sales` (id)');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA255179F07 FOREIGN KEY (fiche_shop_id) REFERENCES fiche_shop (id)');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA2E8D74410 FOREIGN KEY (merchant_id_id) REFERENCES merchant (id)');
        $this->addSql('ALTER TABLE shop_category_shop ADD CONSTRAINT FK_39EDA1EA4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shop_category_shop ADD CONSTRAINT FK_39EDA1EA8ACE84A3 FOREIGN KEY (category_shop_id) REFERENCES category_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F7984584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE super_admin ADD CONSTRAINT FK_BC8C2783BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE value ADD CONSTRAINT FK_1D77583446AF233F FOREIGN KEY (option_id_id) REFERENCES `option` (id)');
    }
 
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B71D650BA4');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7DE18E50B');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1F7BFE87C');
        $this->addSql('ALTER TABLE gift_code DROP FOREIGN KEY FK_8568C2C5B852C405');
        $this->addSql('ALTER TABLE image_shop DROP FOREIGN KEY FK_5E50A63C4D16C4DD');
        $this->addSql('ALTER TABLE info_fiche_shop DROP FOREIGN KEY FK_1E1FE78555179F07');
        $this->addSql('ALTER TABLE keyword DROP FOREIGN KEY FK_5A93713B4584665A');
        $this->addSql('ALTER TABLE loyalty_card DROP FOREIGN KEY FK_EAB8BCBD4B44155D');
        $this->addSql('ALTER TABLE `member` DROP FOREIGN KEY FK_70E4FA78BF396750');
        $this->addSql('ALTER TABLE member_review_product DROP FOREIGN KEY FK_AC4969E97597D3FE');
        $this->addSql('ALTER TABLE member_review_product DROP FOREIGN KEY FK_AC4969E93214A757');
        $this->addSql('ALTER TABLE member_review_shop DROP FOREIGN KEY FK_97E315787597D3FE');
        $this->addSql('ALTER TABLE member_review_shop DROP FOREIGN KEY FK_97E31578D6F8702A');
        $this->addSql('ALTER TABLE merchant DROP FOREIGN KEY FK_74AB25E1BF396750');
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B04584665A');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984B80CDB8');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981D650BA4');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6FCDAEAAA');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE order_shop DROP FOREIGN KEY FK_E19B76B54D16C4DD');
        $this->addSql('ALTER TABLE order_shop DROP FOREIGN KEY FK_E19B76B5FCDAEAAA');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADB852C405');
        $this->addSql('ALTER TABLE product_image DROP FOREIGN KEY FK_64617F034584665A');
        $this->addSql('ALTER TABLE product_info DROP FOREIGN KEY FK_466113F64584665A');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849551D650BA4');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B852C405');
        $this->addSql('ALTER TABLE sales_image DROP FOREIGN KEY FK_3379B5E9A4522A07');
        $this->addSql('ALTER TABLE sales_target DROP FOREIGN KEY FK_649B7DF4A4522A07');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA255179F07');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA2E8D74410');
        $this->addSql('ALTER TABLE shop_category_shop DROP FOREIGN KEY FK_39EDA1EA4D16C4DD');
        $this->addSql('ALTER TABLE shop_category_shop DROP FOREIGN KEY FK_39EDA1EA8ACE84A3');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F7984584665A');
        $this->addSql('ALTER TABLE super_admin DROP FOREIGN KEY FK_BC8C2783BF396750');
        $this->addSql('ALTER TABLE value DROP FOREIGN KEY FK_1D77583446AF233F');
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
        $this->addSql('DROP TABLE member_review_product');
        $this->addSql('DROP TABLE member_review_shop');
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
        $this->addSql('DROP TABLE `sales`');
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
   