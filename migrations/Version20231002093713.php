<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002093713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8B08996ED');
        $this->addSql('DROP INDEX IDX_E33BD3B8B08996ED ON candidature');
        $this->addSql('ALTER TABLE candidature DROP offre_emploi_id');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D14CC8505A');
        $this->addSql('DROP INDEX IDX_132AD0D14CC8505A ON offre_emploi');
        $this->addSql('ALTER TABLE offre_emploi DROP offre_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_emploi ADD offre_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D14CC8505A FOREIGN KEY (offre_id) REFERENCES candidature (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_132AD0D14CC8505A ON offre_emploi (offre_id)');
        $this->addSql('ALTER TABLE candidature ADD offre_emploi_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8B08996ED FOREIGN KEY (offre_emploi_id) REFERENCES offre_emploi (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E33BD3B8B08996ED ON candidature (offre_emploi_id)');
    }
}
