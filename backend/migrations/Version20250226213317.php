<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226213317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member_review_product DROP FOREIGN KEY FK_AC4969E93214A757');
        $this->addSql('ALTER TABLE member_review_product DROP FOREIGN KEY FK_AC4969E97597D3FE');
        $this->addSql('ALTER TABLE member_review_shop DROP FOREIGN KEY FK_97E31578D6F8702A');
        $this->addSql('ALTER TABLE member_review_shop DROP FOREIGN KEY FK_97E315787597D3FE');
        $this->addSql('DROP TABLE member_review_product');
        $this->addSql('DROP TABLE member_review_shop');
        $this->addSql('ALTER TABLE review_product ADD member_id INT NOT NULL, ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE review_product ADD CONSTRAINT FK_48A4B05A7597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE review_product ADD CONSTRAINT FK_48A4B05A4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_48A4B05A7597D3FE ON review_product (member_id)');
        $this->addSql('CREATE INDEX IDX_48A4B05A4584665A ON review_product (product_id)');
        $this->addSql('ALTER TABLE review_shop ADD member_id INT NOT NULL, ADD shop_id INT NOT NULL');
        $this->addSql('ALTER TABLE review_shop ADD CONSTRAINT FK_4EDE01BA7597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE review_shop ADD CONSTRAINT FK_4EDE01BA4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('CREATE INDEX IDX_4EDE01BA7597D3FE ON review_shop (member_id)');
        $this->addSql('CREATE INDEX IDX_4EDE01BA4D16C4DD ON review_shop (shop_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE member_review_product (member_id INT NOT NULL, review_product_id INT NOT NULL, INDEX IDX_AC4969E97597D3FE (member_id), INDEX IDX_AC4969E93214A757 (review_product_id), PRIMARY KEY(member_id, review_product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE member_review_shop (member_id INT NOT NULL, review_shop_id INT NOT NULL, INDEX IDX_97E315787597D3FE (member_id), INDEX IDX_97E31578D6F8702A (review_shop_id), PRIMARY KEY(member_id, review_shop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE member_review_product ADD CONSTRAINT FK_AC4969E93214A757 FOREIGN KEY (review_product_id) REFERENCES review_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_review_product ADD CONSTRAINT FK_AC4969E97597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_review_shop ADD CONSTRAINT FK_97E31578D6F8702A FOREIGN KEY (review_shop_id) REFERENCES review_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_review_shop ADD CONSTRAINT FK_97E315787597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review_product DROP FOREIGN KEY FK_48A4B05A7597D3FE');
        $this->addSql('ALTER TABLE review_product DROP FOREIGN KEY FK_48A4B05A4584665A');
        $this->addSql('DROP INDEX IDX_48A4B05A7597D3FE ON review_product');
        $this->addSql('DROP INDEX IDX_48A4B05A4584665A ON review_product');
        $this->addSql('ALTER TABLE review_product DROP member_id, DROP product_id');
        $this->addSql('ALTER TABLE review_shop DROP FOREIGN KEY FK_4EDE01BA7597D3FE');
        $this->addSql('ALTER TABLE review_shop DROP FOREIGN KEY FK_4EDE01BA4D16C4DD');
        $this->addSql('DROP INDEX IDX_4EDE01BA7597D3FE ON review_shop');
        $this->addSql('DROP INDEX IDX_4EDE01BA4D16C4DD ON review_shop');
        $this->addSql('ALTER TABLE review_shop DROP member_id, DROP shop_id');
    }
}
