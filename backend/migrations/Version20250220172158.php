<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220172158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_shop ADD shop_id INT NOT NULL, ADD order_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_shop ADD CONSTRAINT FK_E19B76B54D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE order_shop ADD CONSTRAINT FK_E19B76B5FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_E19B76B54D16C4DD ON order_shop (shop_id)');
        $this->addSql('CREATE INDEX IDX_E19B76B5FCDAEAAA ON order_shop (order_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_shop DROP FOREIGN KEY FK_E19B76B54D16C4DD');
        $this->addSql('ALTER TABLE order_shop DROP FOREIGN KEY FK_E19B76B5FCDAEAAA');
        $this->addSql('DROP INDEX IDX_E19B76B54D16C4DD ON order_shop');
        $this->addSql('DROP INDEX IDX_E19B76B5FCDAEAAA ON order_shop');
        $this->addSql('ALTER TABLE order_shop DROP shop_id, DROP order_id_id');
    }
}
