<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226210917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gift_code_target ADD gift_code_id INT NOT NULL');
        $this->addSql('ALTER TABLE gift_code_target ADD CONSTRAINT FK_E9CBD694B80CDB8 FOREIGN KEY (gift_code_id) REFERENCES gift_code (id)');
        $this->addSql('CREATE INDEX IDX_E9CBD694B80CDB8 ON gift_code_target (gift_code_id)');
        $this->addSql('ALTER TABLE sales ADD shop_id INT NOT NULL');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT FK_6B8170444D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('CREATE INDEX IDX_6B8170444D16C4DD ON sales (shop_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gift_code_target DROP FOREIGN KEY FK_E9CBD694B80CDB8');
        $this->addSql('DROP INDEX IDX_E9CBD694B80CDB8 ON gift_code_target');
        $this->addSql('ALTER TABLE gift_code_target DROP gift_code_id');
        $this->addSql('ALTER TABLE `sales` DROP FOREIGN KEY FK_6B8170444D16C4DD');
        $this->addSql('DROP INDEX IDX_6B8170444D16C4DD ON `sales`');
        $this->addSql('ALTER TABLE `sales` DROP shop_id');
    }
}
