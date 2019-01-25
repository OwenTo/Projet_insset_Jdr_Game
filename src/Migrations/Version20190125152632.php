<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190125152632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE personnage (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, inventaire_bourse_id INT DEFAULT NULL, user_id INT NOT NULL, inventaire_id INT DEFAULT NULL, nom_personnage VARCHAR(255) NOT NULL, prenom_personnage VARCHAR(255) NOT NULL, description_personnege LONGTEXT DEFAULT NULL, sexe VARCHAR(255) NOT NULL, age INT NOT NULL, poids DOUBLE PRECISION NOT NULL, taille DOUBLE PRECISION NOT NULL, niveau INT NOT NULL, INDEX IDX_6AEA486D8F5EA509 (classe_id), UNIQUE INDEX UNIQ_6AEA486D6317D220 (inventaire_bourse_id), INDEX IDX_6AEA486DA76ED395 (user_id), UNIQUE INDEX UNIQ_6AEA486DCE430A85 (inventaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage_langue (personnage_id INT NOT NULL, langue_id INT NOT NULL, INDEX IDX_55F1FF305E315342 (personnage_id), INDEX IDX_55F1FF302AADBACD (langue_id), PRIMARY KEY(personnage_id, langue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe_personnage (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D6317D220 FOREIGN KEY (inventaire_bourse_id) REFERENCES inventaire_bourse (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486DCE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('ALTER TABLE personnage_langue ADD CONSTRAINT FK_55F1FF305E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnage_langue ADD CONSTRAINT FK_55F1FF302AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compagnon ADD personnage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compagnon ADD CONSTRAINT FK_63EA77665E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('CREATE INDEX IDX_63EA77665E315342 ON compagnon (personnage_id)');
        $this->addSql('ALTER TABLE niveau_metier ADD personnage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE niveau_metier ADD CONSTRAINT FK_F594AE135E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('CREATE INDEX IDX_F594AE135E315342 ON niveau_metier (personnage_id)');
        $this->addSql('ALTER TABLE rang_guilde ADD personnage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rang_guilde ADD CONSTRAINT FK_7797BEBE5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('CREATE INDEX IDX_7797BEBE5E315342 ON rang_guilde (personnage_id)');
        $this->addSql('ALTER TABLE valeur_caract ADD personnage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE valeur_caract ADD CONSTRAINT FK_F1E7E0165E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('CREATE INDEX IDX_F1E7E0165E315342 ON valeur_caract (personnage_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compagnon DROP FOREIGN KEY FK_63EA77665E315342');
        $this->addSql('ALTER TABLE niveau_metier DROP FOREIGN KEY FK_F594AE135E315342');
        $this->addSql('ALTER TABLE personnage_langue DROP FOREIGN KEY FK_55F1FF305E315342');
        $this->addSql('ALTER TABLE rang_guilde DROP FOREIGN KEY FK_7797BEBE5E315342');
        $this->addSql('ALTER TABLE valeur_caract DROP FOREIGN KEY FK_F1E7E0165E315342');
        $this->addSql('DROP TABLE personnage');
        $this->addSql('DROP TABLE personnage_langue');
        $this->addSql('DROP INDEX IDX_63EA77665E315342 ON compagnon');
        $this->addSql('ALTER TABLE compagnon DROP personnage_id');
        $this->addSql('DROP INDEX IDX_F594AE135E315342 ON niveau_metier');
        $this->addSql('ALTER TABLE niveau_metier DROP personnage_id');
        $this->addSql('DROP INDEX IDX_7797BEBE5E315342 ON rang_guilde');
        $this->addSql('ALTER TABLE rang_guilde DROP personnage_id');
        $this->addSql('DROP INDEX IDX_F1E7E0165E315342 ON valeur_caract');
        $this->addSql('ALTER TABLE valeur_caract DROP personnage_id');
    }
}
