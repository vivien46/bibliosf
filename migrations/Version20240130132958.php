<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240130132958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emprunts (id INT AUTO_INCREMENT NOT NULL, livres_id INT NOT NULL, abonnes_id INT NOT NULL, date_emprunt DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', date_retour DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_38FC80DEBF07F38 (livres_id), INDEX IDX_38FC80DFEDEAEF2 (abonnes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emprunts ADD CONSTRAINT FK_38FC80DEBF07F38 FOREIGN KEY (livres_id) REFERENCES livres (id)');
        $this->addSql('ALTER TABLE emprunts ADD CONSTRAINT FK_38FC80DFEDEAEF2 FOREIGN KEY (abonnes_id) REFERENCES abonnes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunts DROP FOREIGN KEY FK_38FC80DEBF07F38');
        $this->addSql('ALTER TABLE emprunts DROP FOREIGN KEY FK_38FC80DFEDEAEF2');
        $this->addSql('DROP TABLE emprunts');
    }
}
