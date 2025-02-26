<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226191859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE qna DROP FOREIGN KEY FK_6BB9CC92A76ED395');
        $this->addSql('DROP INDEX IDX_6BB9CC92A76ED395 ON qna');
        $this->addSql('ALTER TABLE qna ADD sender_super_admin_id INT DEFAULT NULL, CHANGE user_id sender_admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE qna ADD CONSTRAINT FK_6BB9CC9268106FEE FOREIGN KEY (sender_admin_id) REFERENCES `admin` (id)');
        $this->addSql('ALTER TABLE qna ADD CONSTRAINT FK_6BB9CC926A15E0F8 FOREIGN KEY (sender_super_admin_id) REFERENCES super_admin (id)');
        $this->addSql('CREATE INDEX IDX_6BB9CC9268106FEE ON qna (sender_admin_id)');
        $this->addSql('CREATE INDEX IDX_6BB9CC926A15E0F8 ON qna (sender_super_admin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE qna DROP FOREIGN KEY FK_6BB9CC9268106FEE');
        $this->addSql('ALTER TABLE qna DROP FOREIGN KEY FK_6BB9CC926A15E0F8');
        $this->addSql('DROP INDEX IDX_6BB9CC9268106FEE ON qna');
        $this->addSql('DROP INDEX IDX_6BB9CC926A15E0F8 ON qna');
        $this->addSql('ALTER TABLE qna ADD user_id INT DEFAULT NULL, DROP sender_admin_id, DROP sender_super_admin_id');
        $this->addSql('ALTER TABLE qna ADD CONSTRAINT FK_6BB9CC92A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_6BB9CC92A76ED395 ON qna (user_id)');
    }
}
