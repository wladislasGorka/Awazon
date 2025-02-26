<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226173203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE forum_message ADD forum_subject_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0E800861C2 FOREIGN KEY (forum_subject_id) REFERENCES forum_subject (id)');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_47717D0E800861C2 ON forum_message (forum_subject_id)');
        $this->addSql('CREATE INDEX IDX_47717D0EA76ED395 ON forum_message (user_id)');
        $this->addSql('ALTER TABLE forum_subject ADD forum_section_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE forum_subject ADD CONSTRAINT FK_A02730B5A155E3F FOREIGN KEY (forum_section_id) REFERENCES forum_section (id)');
        $this->addSql('ALTER TABLE forum_subject ADD CONSTRAINT FK_A02730BA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_A02730B5A155E3F ON forum_subject (forum_section_id)');
        $this->addSql('CREATE INDEX IDX_A02730BA76ED395 ON forum_subject (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE forum_message DROP FOREIGN KEY FK_47717D0E800861C2');
        $this->addSql('ALTER TABLE forum_message DROP FOREIGN KEY FK_47717D0EA76ED395');
        $this->addSql('DROP INDEX IDX_47717D0E800861C2 ON forum_message');
        $this->addSql('DROP INDEX IDX_47717D0EA76ED395 ON forum_message');
        $this->addSql('ALTER TABLE forum_message DROP forum_subject_id, DROP user_id');
        $this->addSql('ALTER TABLE forum_subject DROP FOREIGN KEY FK_A02730B5A155E3F');
        $this->addSql('ALTER TABLE forum_subject DROP FOREIGN KEY FK_A02730BA76ED395');
        $this->addSql('DROP INDEX IDX_A02730B5A155E3F ON forum_subject');
        $this->addSql('DROP INDEX IDX_A02730BA76ED395 ON forum_subject');
        $this->addSql('ALTER TABLE forum_subject DROP forum_section_id, DROP user_id');
    }
}
