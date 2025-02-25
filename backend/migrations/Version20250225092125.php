<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250225092125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart ADD member_id_id INT NOT NULL, ADD product_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B71D650BA4 FOREIGN KEY (member_id_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_BA388B71D650BA4 ON cart (member_id_id)');
        $this->addSql('CREATE INDEX IDX_BA388B7DE18E50B ON cart (product_id_id)');
        $this->addSql('ALTER TABLE reservation ADD member_id_id INT DEFAULT NULL, ADD shop_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849551D650BA4 FOREIGN KEY (member_id_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B852C405 FOREIGN KEY (shop_id_id) REFERENCES shop (id)');
        $this->addSql('CREATE INDEX IDX_42C849551D650BA4 ON reservation (member_id_id)');
        $this->addSql('CREATE INDEX IDX_42C84955B852C405 ON reservation (shop_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B71D650BA4');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7DE18E50B');
        $this->addSql('DROP INDEX IDX_BA388B71D650BA4 ON cart');
        $this->addSql('DROP INDEX IDX_BA388B7DE18E50B ON cart');
        $this->addSql('ALTER TABLE cart DROP member_id_id, DROP product_id_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849551D650BA4');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B852C405');
        $this->addSql('DROP INDEX IDX_42C849551D650BA4 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955B852C405 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP member_id_id, DROP shop_id_id');
    }
}
