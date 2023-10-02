<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002092027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidate (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, profil_picture_id INT NOT NULL, passport_id INT NOT NULL, cv_id INT NOT NULL, gender VARCHAR(50) NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, adress VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, nationality VARCHAR(100) NOT NULL, is_passport_valid TINYINT(1) NOT NULL, date_birth DATE NOT NULL, place_birth VARCHAR(255) NOT NULL, is_available TINYINT(1) NOT NULL, job_category VARCHAR(255) NOT NULL, experience VARCHAR(255) NOT NULL, short_description LONGTEXT NOT NULL, notes LONGTEXT DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, date_deleted DATETIME NOT NULL, UNIQUE INDEX UNIQ_C8B28E44A76ED395 (user_id), UNIQUE INDEX UNIQ_C8B28E44D583E641 (profil_picture_id), UNIQUE INDEX UNIQ_C8B28E44ABF410D0 (passport_id), UNIQUE INDEX UNIQ_C8B28E44CFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidature (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, offre_emploi_id INT NOT NULL, INDEX IDX_E33BD3B891BD8781 (candidate_id), INDEX IDX_E33BD3B8B08996ED (offre_emploi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, activity_type VARCHAR(255) NOT NULL, contact_name VARCHAR(255) NOT NULL, contact_post VARCHAR(255) NOT NULL, contact_email VARCHAR(255) NOT NULL, notes VARCHAR(500) NOT NULL, contact_phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_emploi (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, offre_id INT NOT NULL, ref VARCHAR(500) NOT NULL, description VARCHAR(500) NOT NULL, is_active TINYINT(1) NOT NULL, notes VARCHAR(500) NOT NULL, job_title VARCHAR(255) NOT NULL, job_type VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, job_category VARCHAR(255) NOT NULL, closing_date DATE NOT NULL, salary INT NOT NULL, date_creation DATE NOT NULL, INDEX IDX_132AD0D119EB6921 (client_id), INDEX IDX_132AD0D14CC8505A (offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44D583E641 FOREIGN KEY (profil_picture_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44ABF410D0 FOREIGN KEY (passport_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44CFE419E2 FOREIGN KEY (cv_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B891BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8B08996ED FOREIGN KEY (offre_emploi_id) REFERENCES offre_emploi (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D14CC8505A FOREIGN KEY (offre_id) REFERENCES candidature (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44A76ED395');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44D583E641');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44ABF410D0');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44CFE419E2');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B891BD8781');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8B08996ED');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D119EB6921');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D14CC8505A');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('DROP TABLE candidature');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE offre_emploi');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE user');
    }
}
