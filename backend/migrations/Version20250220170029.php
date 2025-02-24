<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<<< HEAD:backend/migrations/Version20250219134313.php
final class Version20250219134313 extends AbstractMigration
========
final class Version20250220170029 extends AbstractMigration
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/migrations/Version20250220170029.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:backend/migrations/Version20250219134313.php
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
========
        $this->addSql('DROP TABLE type_shop');
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/migrations/Version20250220170029.php
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:backend/migrations/Version20250219134313.php
        $this->addSql('DROP TABLE `option`');
========
        $this->addSql('CREATE TABLE type_shop (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/migrations/Version20250220170029.php
    }
}
