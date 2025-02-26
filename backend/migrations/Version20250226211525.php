<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226211525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE member_shop (member_id INT NOT NULL, shop_id INT NOT NULL, INDEX IDX_50E260FE7597D3FE (member_id), INDEX IDX_50E260FE4D16C4DD (shop_id), PRIMARY KEY(member_id, shop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_product (member_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_6CBEB3397597D3FE (member_id), INDEX IDX_6CBEB3394584665A (product_id), PRIMARY KEY(member_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE member_shop ADD CONSTRAINT FK_50E260FE7597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_shop ADD CONSTRAINT FK_50E260FE4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_product ADD CONSTRAINT FK_6CBEB3397597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_product ADD CONSTRAINT FK_6CBEB3394584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member_shop DROP FOREIGN KEY FK_50E260FE7597D3FE');
        $this->addSql('ALTER TABLE member_shop DROP FOREIGN KEY FK_50E260FE4D16C4DD');
        $this->addSql('ALTER TABLE member_product DROP FOREIGN KEY FK_6CBEB3397597D3FE');
        $this->addSql('ALTER TABLE member_product DROP FOREIGN KEY FK_6CBEB3394584665A');
        $this->addSql('DROP TABLE member_shop');
        $this->addSql('DROP TABLE member_product');
    }
}
