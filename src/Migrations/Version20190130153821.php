<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130153821 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE personnage (id INT AUTO_INCREMENT NOT NULL, inventaire_bourse_id INT DEFAULT NULL, user_id INT NOT NULL, inventaire_id INT DEFAULT NULL, classe_id INT NOT NULL, nom_personnage VARCHAR(255) NOT NULL, prenom_personnage VARCHAR(255) NOT NULL, description_personnege LONGTEXT DEFAULT NULL, sexe VARCHAR(255) NOT NULL, age INT NOT NULL, poids DOUBLE PRECISION NOT NULL, taille DOUBLE PRECISION NOT NULL, niveau INT NOT NULL, UNIQUE INDEX UNIQ_6AEA486D6317D220 (inventaire_bourse_id), INDEX IDX_6AEA486DA76ED395 (user_id), UNIQUE INDEX UNIQ_6AEA486DCE430A85 (inventaire_id), INDEX IDX_6AEA486D8F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage_langue (personnage_id INT NOT NULL, langue_id INT NOT NULL, INDEX IDX_55F1FF305E315342 (personnage_id), INDEX IDX_55F1FF302AADBACD (langue_id), PRIMARY KEY(personnage_id, langue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rang_guilde (id INT AUTO_INCREMENT NOT NULL, guilde_id INT NOT NULL, personnage_id INT DEFAULT NULL, rang VARCHAR(255) NOT NULL, INDEX IDX_7797BEBEA2E96BBE (guilde_id), UNIQUE INDEX UNIQ_7797BEBE5E315342 (personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, type_des_id INT DEFAULT NULL, monnaie_id INT DEFAULT NULL, nom_item VARCHAR(255) NOT NULL, description_item LONGTEXT DEFAULT NULL, poids DOUBLE PRECISION NOT NULL, benefice_maluce LONGTEXT DEFAULT NULL, valeur INT NOT NULL, enfant VARCHAR(255) NOT NULL, INDEX IDX_1F1B251EB0286CBA (type_des_id), INDEX IDX_1F1B251E98D3FE22 (monnaie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE capacite_racial (id INT AUTO_INCREMENT NOT NULL, capacite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE capacite_racial_race (capacite_racial_id INT NOT NULL, race_id INT NOT NULL, INDEX IDX_A5B6F9F896AF05A8 (capacite_racial_id), INDEX IDX_A5B6F9F86E59D40D (race_id), PRIMARY KEY(capacite_racial_id, race_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique (id INT AUTO_INCREMENT NOT NULL, nom_caracteristique VARCHAR(255) NOT NULL, enfant VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique_principal (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique_secondaire (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_personnage (id INT AUTO_INCREMENT NOT NULL, nom_classe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagnon (id INT AUTO_INCREMENT NOT NULL, compagnon_type_id INT NOT NULL, race_id INT NOT NULL, personnage_id INT DEFAULT NULL, sexe VARCHAR(255) NOT NULL, prix_achat_vente INT DEFAULT NULL, nom_compagnon VARCHAR(255) NOT NULL, INDEX IDX_63EA7766E7021F0E (compagnon_type_id), INDEX IDX_63EA77666E59D40D (race_id), INDEX IDX_63EA77665E315342 (personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagnon_type (id INT AUTO_INCREMENT NOT NULL, type_compagnon VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guilde (id INT AUTO_INCREMENT NOT NULL, type_guilde_id INT NOT NULL, nom_guilde VARCHAR(255) NOT NULL, maitre_guilde VARCHAR(255) NOT NULL, INDEX IDX_AEAB4047162F2AAE (type_guilde_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire_bourse (id INT AUTO_INCREMENT NOT NULL, valeur_bourse_perso INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue_type_langue (langue_type_id INT NOT NULL, langue_id INT NOT NULL, INDEX IDX_406E0DCDCEC86005 (langue_type_id), INDEX IDX_406E0DCD2AADBACD (langue_id), PRIMARY KEY(langue_type_id, langue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, nom_metier VARCHAR(255) NOT NULL, specialisation_metier VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau_metier (id INT AUTO_INCREMENT NOT NULL, metier_id INT NOT NULL, personnage_id INT DEFAULT NULL, niveau_metier INT NOT NULL, INDEX IDX_F594AE13ED16FA20 (metier_id), INDEX IDX_F594AE135E315342 (personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom_partie VARCHAR(255) NOT NULL, INDEX IDX_59B1F3DFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, type_race_id INT NOT NULL, nom_race VARCHAR(255) NOT NULL, description_race VARCHAR(255) DEFAULT NULL, INDEX IDX_DA6FBBAF4678BBF8 (type_race_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region_langue (id INT AUTO_INCREMENT NOT NULL, region_langue VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D6317D220 FOREIGN KEY (inventaire_bourse_id) REFERENCES inventaire_bourse (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486DCE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe_personnage (id)');
        $this->addSql('ALTER TABLE personnage_langue ADD CONSTRAINT FK_55F1FF305E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnage_langue ADD CONSTRAINT FK_55F1FF302AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rang_guilde ADD CONSTRAINT FK_7797BEBEA2E96BBE FOREIGN KEY (guilde_id) REFERENCES guilde (id)');
        $this->addSql('ALTER TABLE rang_guilde ADD CONSTRAINT FK_7797BEBE5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EB0286CBA FOREIGN KEY (type_des_id) REFERENCES type_des (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E98D3FE22 FOREIGN KEY (monnaie_id) REFERENCES monnaie (id)');
        $this->addSql('ALTER TABLE capacite_racial_race ADD CONSTRAINT FK_A5B6F9F896AF05A8 FOREIGN KEY (capacite_racial_id) REFERENCES capacite_racial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE capacite_racial_race ADD CONSTRAINT FK_A5B6F9F86E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_principal ADD CONSTRAINT FK_E761C0FBF396750 FOREIGN KEY (id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_secondaire ADD CONSTRAINT FK_1DB31BE2BF396750 FOREIGN KEY (id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compagnon ADD CONSTRAINT FK_63EA7766E7021F0E FOREIGN KEY (compagnon_type_id) REFERENCES compagnon_type (id)');
        $this->addSql('ALTER TABLE compagnon ADD CONSTRAINT FK_63EA77666E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE compagnon ADD CONSTRAINT FK_63EA77665E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE guilde ADD CONSTRAINT FK_AEAB4047162F2AAE FOREIGN KEY (type_guilde_id) REFERENCES type_guilde (id)');
        $this->addSql('ALTER TABLE langue_type_langue ADD CONSTRAINT FK_406E0DCDCEC86005 FOREIGN KEY (langue_type_id) REFERENCES langue_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE langue_type_langue ADD CONSTRAINT FK_406E0DCD2AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE niveau_metier ADD CONSTRAINT FK_F594AE13ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('ALTER TABLE niveau_metier ADD CONSTRAINT FK_F594AE135E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE race ADD CONSTRAINT FK_DA6FBBAF4678BBF8 FOREIGN KEY (type_race_id) REFERENCES type_race (id)');
        $this->addSql('ALTER TABLE langue ADD CONSTRAINT FK_9357758E98260155 FOREIGN KEY (region_id) REFERENCES region_langue (id)');
        $this->addSql('ALTER TABLE talent DROP FOREIGN KEY FK_16D902F5ACB13DFF');
        $this->addSql('DROP INDEX IDX_16D902F5ACB13DFF ON talent');
        $this->addSql('ALTER TABLE talent DROP type_talent_id');
        $this->addSql('ALTER TABLE type_talent ADD coll_talent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_talent ADD CONSTRAINT FK_350E69CDC9734CAC FOREIGN KEY (coll_talent_id) REFERENCES talent (id)');
        $this->addSql('CREATE INDEX IDX_350E69CDC9734CAC ON type_talent (coll_talent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE personnage_langue DROP FOREIGN KEY FK_55F1FF305E315342');
        $this->addSql('ALTER TABLE rang_guilde DROP FOREIGN KEY FK_7797BEBE5E315342');
        $this->addSql('ALTER TABLE compagnon DROP FOREIGN KEY FK_63EA77665E315342');
        $this->addSql('ALTER TABLE niveau_metier DROP FOREIGN KEY FK_F594AE135E315342');
        $this->addSql('ALTER TABLE valeur_caract DROP FOREIGN KEY FK_F1E7E0165E315342');
        $this->addSql('ALTER TABLE arme DROP FOREIGN KEY FK_18207379BF396750');
        $this->addSql('ALTER TABLE armure DROP FOREIGN KEY FK_4ADFC535BF396750');
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551F126F525E');
        $this->addSql('ALTER TABLE magie DROP FOREIGN KEY FK_E0654C1BBF396750');
        $this->addSql('ALTER TABLE capacite_racial_race DROP FOREIGN KEY FK_A5B6F9F896AF05A8');
        $this->addSql('ALTER TABLE caracteristique_principal DROP FOREIGN KEY FK_E761C0FBF396750');
        $this->addSql('ALTER TABLE caracteristique_secondaire DROP FOREIGN KEY FK_1DB31BE2BF396750');
        $this->addSql('ALTER TABLE valeur_caract DROP FOREIGN KEY FK_F1E7E0161704EEB7');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D8F5EA509');
        $this->addSql('ALTER TABLE compagnon DROP FOREIGN KEY FK_63EA7766E7021F0E');
        $this->addSql('ALTER TABLE rang_guilde DROP FOREIGN KEY FK_7797BEBEA2E96BBE');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486DCE430A85');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D6317D220');
        $this->addSql('ALTER TABLE niveau_metier DROP FOREIGN KEY FK_F594AE13ED16FA20');
        $this->addSql('ALTER TABLE capacite_racial_race DROP FOREIGN KEY FK_A5B6F9F86E59D40D');
        $this->addSql('ALTER TABLE compagnon DROP FOREIGN KEY FK_63EA77666E59D40D');
        $this->addSql('ALTER TABLE langue DROP FOREIGN KEY FK_9357758E98260155');
        $this->addSql('DROP TABLE personnage');
        $this->addSql('DROP TABLE personnage_langue');
        $this->addSql('DROP TABLE rang_guilde');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE capacite_racial');
        $this->addSql('DROP TABLE capacite_racial_race');
        $this->addSql('DROP TABLE caracteristique');
        $this->addSql('DROP TABLE caracteristique_principal');
        $this->addSql('DROP TABLE caracteristique_secondaire');
        $this->addSql('DROP TABLE classe_personnage');
        $this->addSql('DROP TABLE compagnon');
        $this->addSql('DROP TABLE compagnon_type');
        $this->addSql('DROP TABLE guilde');
        $this->addSql('DROP TABLE inventaire');
        $this->addSql('DROP TABLE inventaire_bourse');
        $this->addSql('DROP TABLE langue_type_langue');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE niveau_metier');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE region_langue');
        $this->addSql('ALTER TABLE talent ADD type_talent_id INT NOT NULL');
        $this->addSql('ALTER TABLE talent ADD CONSTRAINT FK_16D902F5ACB13DFF FOREIGN KEY (type_talent_id) REFERENCES type_talent (id)');
        $this->addSql('CREATE INDEX IDX_16D902F5ACB13DFF ON talent (type_talent_id)');
        $this->addSql('ALTER TABLE type_talent DROP FOREIGN KEY FK_350E69CDC9734CAC');
        $this->addSql('DROP INDEX IDX_350E69CDC9734CAC ON type_talent');
        $this->addSql('ALTER TABLE type_talent DROP coll_talent_id');
    }
}
