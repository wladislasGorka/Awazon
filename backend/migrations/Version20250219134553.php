<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<<< HEAD:backend/migrations/Version20250219112824.php
final class Version20250219112824 extends AbstractMigration
========
final class Version20250219134553 extends AbstractMigration
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/migrations/Version20250219134553.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:backend/migrations/Version20250219112824.php
        $this->addSql('ALTER TABLE product CHANGE price price DOUBLE PRECISION NOT NULL');
========
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(50) NOT NULL, phone INT NOT NULL, register_date DATETIME NOT NULL, login_date DATETIME NOT NULL, email_verif TINYINT(1) NOT NULL, status VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/migrations/Version20250219134553.php
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:backend/migrations/Version20250219112824.php
        $this->addSql('ALTER TABLE product CHANGE price price VARCHAR(50) NOT NULL');
========
        $this->addSql('DROP TABLE users');
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/migrations/Version20250219134553.php
    }
}
