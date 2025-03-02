<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250227174314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1F7BFE87C');
        $this->addSql('DROP INDEX IDX_64C19C1F7BFE87C ON category');
        $this->addSql('ALTER TABLE category DROP sub_category_id');
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
        $this->addSql('ALTER TABLE newsletter ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_7E8585C8A76ED395 ON newsletter (user_id)');
        $this->addSql('ALTER TABLE product ADD sub_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADF7BFE87C ON product (sub_category_id)');
        $this->addSql('ALTER TABLE qna ADD sender_admin_id INT DEFAULT NULL, ADD sender_super_admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE qna ADD CONSTRAINT FK_6BB9CC9268106FEE FOREIGN KEY (sender_admin_id) REFERENCES `admin` (id)');
        $this->addSql('ALTER TABLE qna ADD CONSTRAINT FK_6BB9CC926A15E0F8 FOREIGN KEY (sender_super_admin_id) REFERENCES super_admin (id)');
        $this->addSql('CREATE INDEX IDX_6BB9CC9268106FEE ON qna (sender_admin_id)');
        $this->addSql('CREATE INDEX IDX_6BB9CC926A15E0F8 ON qna (sender_super_admin_id)');
        $this->addSql('ALTER TABLE report ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_C42F7784A76ED395 ON report (user_id)');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F7984584665A');
        $this->addSql('DROP INDEX IDX_BCE3F7984584665A ON sub_category');
        $this->addSql('ALTER TABLE sub_category CHANGE product_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F79812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_BCE3F79812469DE2 ON sub_category (category_id)');
        $this->addSql('ALTER TABLE ticket ADD sender_id INT NOT NULL, ADD recipient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3F624B39D FOREIGN KEY (sender_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3E92F8F78 FOREIGN KEY (recipient_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3F624B39D ON ticket (sender_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3E92F8F78 ON ticket (recipient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD sub_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1F7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_64C19C1F7BFE87C ON category (sub_category_id)');
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
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C8A76ED395');
        $this->addSql('DROP INDEX IDX_7E8585C8A76ED395 ON newsletter');
        $this->addSql('ALTER TABLE newsletter DROP user_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADF7BFE87C');
        $this->addSql('DROP INDEX IDX_D34A04ADF7BFE87C ON product');
        $this->addSql('ALTER TABLE product DROP sub_category_id');
        $this->addSql('ALTER TABLE qna DROP FOREIGN KEY FK_6BB9CC9268106FEE');
        $this->addSql('ALTER TABLE qna DROP FOREIGN KEY FK_6BB9CC926A15E0F8');
        $this->addSql('DROP INDEX IDX_6BB9CC9268106FEE ON qna');
        $this->addSql('DROP INDEX IDX_6BB9CC926A15E0F8 ON qna');
        $this->addSql('ALTER TABLE qna DROP sender_admin_id, DROP sender_super_admin_id');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784A76ED395');
        $this->addSql('DROP INDEX IDX_C42F7784A76ED395 ON report');
        $this->addSql('ALTER TABLE report DROP user_id');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F79812469DE2');
        $this->addSql('DROP INDEX IDX_BCE3F79812469DE2 ON sub_category');
        $this->addSql('ALTER TABLE sub_category CHANGE category_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F7984584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BCE3F7984584665A ON sub_category (product_id)');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3F624B39D');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3E92F8F78');
        $this->addSql('DROP INDEX IDX_97A0ADA3F624B39D ON ticket');
        $this->addSql('DROP INDEX IDX_97A0ADA3E92F8F78 ON ticket');
        $this->addSql('ALTER TABLE ticket DROP sender_id, DROP recipient_id');
    }
}
