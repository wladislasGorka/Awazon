<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226191044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE newsletter ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_7E8585C8A76ED395 ON newsletter (user_id)');
        $this->addSql('ALTER TABLE qna ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE qna ADD CONSTRAINT FK_6BB9CC92A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_6BB9CC92A76ED395 ON qna (user_id)');
        $this->addSql('ALTER TABLE report ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_C42F7784A76ED395 ON report (user_id)');
        $this->addSql('ALTER TABLE ticket ADD sender_id INT NOT NULL, ADD recipient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3F624B39D FOREIGN KEY (sender_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3E92F8F78 FOREIGN KEY (recipient_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3F624B39D ON ticket (sender_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3E92F8F78 ON ticket (recipient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C8A76ED395');
        $this->addSql('DROP INDEX IDX_7E8585C8A76ED395 ON newsletter');
        $this->addSql('ALTER TABLE newsletter DROP user_id');
        $this->addSql('ALTER TABLE qna DROP FOREIGN KEY FK_6BB9CC92A76ED395');
        $this->addSql('DROP INDEX IDX_6BB9CC92A76ED395 ON qna');
        $this->addSql('ALTER TABLE qna DROP user_id');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784A76ED395');
        $this->addSql('DROP INDEX IDX_C42F7784A76ED395 ON report');
        $this->addSql('ALTER TABLE report DROP user_id');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3F624B39D');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3E92F8F78');
        $this->addSql('DROP INDEX IDX_97A0ADA3F624B39D ON ticket');
        $this->addSql('DROP INDEX IDX_97A0ADA3E92F8F78 ON ticket');
        $this->addSql('ALTER TABLE ticket DROP sender_id, DROP recipient_id');
    }
}
