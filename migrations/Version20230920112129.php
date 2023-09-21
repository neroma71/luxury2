<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920112129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44B6121583');
        $this->addSql('DROP INDEX IDX_C8B28E44B6121583 ON candidate');
        $this->addSql('ALTER TABLE candidate DROP candidature_id');
        $this->addSql('ALTER TABLE candidature ADD candidate_id INT NOT NULL, ADD offre_emploi_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B891BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8B08996ED FOREIGN KEY (offre_emploi_id) REFERENCES offre_emploi (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B891BD8781 ON candidature (candidate_id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B8B08996ED ON candidature (offre_emploi_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate ADD candidature_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44B6121583 FOREIGN KEY (candidature_id) REFERENCES candidature (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C8B28E44B6121583 ON candidate (candidature_id)');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B891BD8781');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8B08996ED');
        $this->addSql('DROP INDEX IDX_E33BD3B891BD8781 ON candidature');
        $this->addSql('DROP INDEX IDX_E33BD3B8B08996ED ON candidature');
        $this->addSql('ALTER TABLE candidature DROP candidate_id, DROP offre_emploi_id');
    }
}
