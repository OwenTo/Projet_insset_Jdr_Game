<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190304183638 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, type_des_id INT DEFAULT NULL, monnaie_id INT DEFAULT NULL, nom_item VARCHAR(255) NOT NULL, description_item LONGTEXT DEFAULT NULL, poids DOUBLE PRECISION NOT NULL, benefice_maluce LONGTEXT DEFAULT NULL, valeur INT NOT NULL, enfant VARCHAR(255) NOT NULL, INDEX IDX_1F1B251EB0286CBA (type_des_id), INDEX IDX_1F1B251E98D3FE22 (monnaie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE arme (id INT NOT NULL, type_arme_id INT DEFAULT NULL, type_categorie_id INT DEFAULT NULL, materiel_id INT DEFAULT NULL, degat INT NOT NULL, INDEX IDX_182073792A3CF3FF (type_arme_id), INDEX IDX_182073793BB65D28 (type_categorie_id), INDEX IDX_1820737916880AAF (materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE armure (id INT NOT NULL, equipement_id INT NOT NULL, materiel_id INT NOT NULL, categorie_id INT DEFAULT NULL, defense INT NOT NULL, INDEX IDX_4ADFC535806F0F5C (equipement_id), INDEX IDX_4ADFC53516880AAF (materiel_id), INDEX IDX_4ADFC535BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE capacite_racial (id INT AUTO_INCREMENT NOT NULL, capacite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE capacite_racial_race (capacite_racial_id INT NOT NULL, race_id INT NOT NULL, INDEX IDX_A5B6F9F896AF05A8 (capacite_racial_id), INDEX IDX_A5B6F9F86E59D40D (race_id), PRIMARY KEY(capacite_racial_id, race_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique (id INT AUTO_INCREMENT NOT NULL, nom_caracteristique VARCHAR(255) NOT NULL, enfant VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique_principal (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique_secondaire (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE choix_personnage (id INT AUTO_INCREMENT NOT NULL, partie_id INT NOT NULL, personnage_id INT NOT NULL, INDEX IDX_62CAEEDEE075F7A4 (partie_id), INDEX IDX_62CAEEDE5E315342 (personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_personnage (id INT AUTO_INCREMENT NOT NULL, nom_classe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagnon (id INT AUTO_INCREMENT NOT NULL, compagnon_type_id INT NOT NULL, race_id INT NOT NULL, sexe VARCHAR(255) NOT NULL, prix_achat_vente INT DEFAULT NULL, nom_compagnon VARCHAR(255) NOT NULL, INDEX IDX_63EA7766E7021F0E (compagnon_type_id), INDEX IDX_63EA77666E59D40D (race_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagnon_type (id INT AUTO_INCREMENT NOT NULL, type_compagnon VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, sujet_mail_id INT DEFAULT NULL, name_contact VARCHAR(255) NOT NULL, email_contact VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, sujet VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL, INDEX IDX_4C62E63845446268 (sujet_mail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom_equipement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fichier (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, user_id INT DEFAULT NULL, contenue_fichier VARCHAR(255) NOT NULL, fichier_extension VARCHAR(255) NOT NULL, create_file_at DATETIME NOT NULL, modif_file_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_9B76551F126F525E (item_id), INDEX IDX_9B76551FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guilde (id INT AUTO_INCREMENT NOT NULL, type_guilde_id INT NOT NULL, nom_guilde VARCHAR(255) NOT NULL, maitre_guilde VARCHAR(255) NOT NULL, INDEX IDX_AEAB4047162F2AAE (type_guilde_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire (id INT AUTO_INCREMENT NOT NULL, items_id INT DEFAULT NULL, personnage_id INT NOT NULL, categorie VARCHAR(255) NOT NULL, INDEX IDX_338920E06BB0AE84 (items_id), INDEX IDX_338920E05E315342 (personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire_item (id INT AUTO_INCREMENT NOT NULL, types_des_id INT DEFAULT NULL, monnaie_id INT DEFAULT NULL, fichier_id INT DEFAULT NULL, nom_item_inventaire VARCHAR(255) NOT NULL, description_item_inventaire LONGTEXT DEFAULT NULL, poids_item_inventaire DOUBLE PRECISION DEFAULT NULL, benefice_maluce_inventaire LONGTEXT DEFAULT NULL, valeur_inventaire INT NOT NULL, enfant VARCHAR(255) NOT NULL, INDEX IDX_D05778DBEC34F8ED (types_des_id), INDEX IDX_D05778DB98D3FE22 (monnaie_id), UNIQUE INDEX UNIQ_D05778DBF915CFE (fichier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire_arme (id INT NOT NULL, type_arme_inventaire_id INT DEFAULT NULL, type_categorie_inventaire_id INT DEFAULT NULL, materiel_inventaire_id INT DEFAULT NULL, degat_arme_inventaire INT NOT NULL, INDEX IDX_D76C2EBC49719342 (type_arme_inventaire_id), INDEX IDX_D76C2EBC9BEEEF7C (type_categorie_inventaire_id), INDEX IDX_D76C2EBC1A7C3E96 (materiel_inventaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire_armure (id INT NOT NULL, equipement_inventaire_id INT DEFAULT NULL, categorie_armure_inventaire_id INT DEFAULT NULL, materiel_armure_inventaire_id INT DEFAULT NULL, defense_armure_inventaire INT NOT NULL, INDEX IDX_E988043B5BCCA5EB (equipement_inventaire_id), INDEX IDX_E988043B10F2BEDF (categorie_armure_inventaire_id), INDEX IDX_E988043B17FB4E5A (materiel_armure_inventaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire_bourse (id INT AUTO_INCREMENT NOT NULL, valeur_bourse_perso INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire_magie (id INT NOT NULL, degat_magie_inventaire INT NOT NULL, cout_mana_magie_inventaire INT NOT NULL, niveau_magie_inventaire INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire_magie_type_magie (inventaire_magie_id INT NOT NULL, type_magie_id INT NOT NULL, INDEX IDX_89826A2B65C66060 (inventaire_magie_id), INDEX IDX_89826A2BDAD93B63 (type_magie_id), PRIMARY KEY(inventaire_magie_id, type_magie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invitation (id INT AUTO_INCREMENT NOT NULL, partie_id INT NOT NULL, player_id INT NOT NULL, status VARCHAR(15) NOT NULL, INDEX IDX_F11D61A2E075F7A4 (partie_id), INDEX IDX_F11D61A299E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, region_id INT DEFAULT NULL, nom_langue VARCHAR(255) NOT NULL, INDEX IDX_9357758E98260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue_type (id INT AUTO_INCREMENT NOT NULL, langue_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue_type_langue (langue_type_id INT NOT NULL, langue_id INT NOT NULL, INDEX IDX_406E0DCDCEC86005 (langue_type_id), INDEX IDX_406E0DCD2AADBACD (langue_id), PRIMARY KEY(langue_type_id, langue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magie (id INT NOT NULL, degat_magie INT NOT NULL, cout_de_mana INT NOT NULL, niveau_magie INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magie_type_magie (magie_id INT NOT NULL, type_magie_id INT NOT NULL, INDEX IDX_11577EBF17261C9F (magie_id), INDEX IDX_11577EBFDAD93B63 (type_magie_id), PRIMARY KEY(magie_id, type_magie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, type_materiel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, nom_metier VARCHAR(255) NOT NULL, specialisation_metier VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monnaie (id INT AUTO_INCREMENT NOT NULL, nom_monnaie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau_metier (id INT AUTO_INCREMENT NOT NULL, metier_id INT NOT NULL, personnage_id INT DEFAULT NULL, niveau_metier INT NOT NULL, INDEX IDX_F594AE13ED16FA20 (metier_id), INDEX IDX_F594AE135E315342 (personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom_partie VARCHAR(255) NOT NULL, INDEX IDX_59B1F3DFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage (id INT AUTO_INCREMENT NOT NULL, inventaire_bourse_id INT DEFAULT NULL, user_id INT NOT NULL, classe_id INT NOT NULL, nom_personnage VARCHAR(255) NOT NULL, prenom_personnage VARCHAR(255) NOT NULL, description_personnege LONGTEXT DEFAULT NULL, sexe VARCHAR(255) NOT NULL, age INT NOT NULL, poids DOUBLE PRECISION NOT NULL, taille DOUBLE PRECISION NOT NULL, niveau INT NOT NULL, UNIQUE INDEX UNIQ_6AEA486D6317D220 (inventaire_bourse_id), INDEX IDX_6AEA486DA76ED395 (user_id), INDEX IDX_6AEA486D8F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage_langue (personnage_id INT NOT NULL, langue_id INT NOT NULL, INDEX IDX_55F1FF305E315342 (personnage_id), INDEX IDX_55F1FF302AADBACD (langue_id), PRIMARY KEY(personnage_id, langue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage_compagnon (personnage_id INT NOT NULL, compagnon_id INT NOT NULL, INDEX IDX_52F3D2A65E315342 (personnage_id), INDEX IDX_52F3D2A6ABA9696 (compagnon_id), PRIMARY KEY(personnage_id, compagnon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, type_race_id INT NOT NULL, nom_race VARCHAR(255) NOT NULL, description_race VARCHAR(255) DEFAULT NULL, INDEX IDX_DA6FBBAF4678BBF8 (type_race_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rang_guilde (id INT AUTO_INCREMENT NOT NULL, guilde_id INT NOT NULL, personnage_id INT DEFAULT NULL, rang VARCHAR(255) NOT NULL, INDEX IDX_7797BEBEA2E96BBE (guilde_id), INDEX IDX_7797BEBE5E315342 (personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region_langue (id INT AUTO_INCREMENT NOT NULL, region_langue VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sujet_mail (id INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE talent (id INT AUTO_INCREMENT NOT NULL, type_talent_id INT NOT NULL, description_talent LONGTEXT DEFAULT NULL, nom_talent VARCHAR(255) NOT NULL, benefice_maluce_talent LONGTEXT DEFAULT NULL, INDEX IDX_16D902F5ACB13DFF (type_talent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_arme (id INT AUTO_INCREMENT NOT NULL, nom_type_arme VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_categorie (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_des (id INT AUTO_INCREMENT NOT NULL, des VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_guilde (id INT AUTO_INCREMENT NOT NULL, type_guilde VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_magie (id INT AUTO_INCREMENT NOT NULL, nom_type_magie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_race (id INT AUTO_INCREMENT NOT NULL, type_race VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_talent (id INT AUTO_INCREMENT NOT NULL, nom_type_talent VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE valeur_caract (id INT AUTO_INCREMENT NOT NULL, caracteristique_id INT NOT NULL, personnage_id INT DEFAULT NULL, valeur INT NOT NULL, INDEX IDX_F1E7E0161704EEB7 (caracteristique_id), INDEX IDX_F1E7E0165E315342 (personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EB0286CBA FOREIGN KEY (type_des_id) REFERENCES type_des (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E98D3FE22 FOREIGN KEY (monnaie_id) REFERENCES monnaie (id)');
        $this->addSql('ALTER TABLE arme ADD CONSTRAINT FK_182073792A3CF3FF FOREIGN KEY (type_arme_id) REFERENCES type_arme (id)');
        $this->addSql('ALTER TABLE arme ADD CONSTRAINT FK_182073793BB65D28 FOREIGN KEY (type_categorie_id) REFERENCES type_categorie (id)');
        $this->addSql('ALTER TABLE arme ADD CONSTRAINT FK_1820737916880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE arme ADD CONSTRAINT FK_18207379BF396750 FOREIGN KEY (id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE armure ADD CONSTRAINT FK_4ADFC535806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE armure ADD CONSTRAINT FK_4ADFC53516880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE armure ADD CONSTRAINT FK_4ADFC535BCF5E72D FOREIGN KEY (categorie_id) REFERENCES type_categorie (id)');
        $this->addSql('ALTER TABLE armure ADD CONSTRAINT FK_4ADFC535BF396750 FOREIGN KEY (id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE capacite_racial_race ADD CONSTRAINT FK_A5B6F9F896AF05A8 FOREIGN KEY (capacite_racial_id) REFERENCES capacite_racial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE capacite_racial_race ADD CONSTRAINT FK_A5B6F9F86E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_principal ADD CONSTRAINT FK_E761C0FBF396750 FOREIGN KEY (id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_secondaire ADD CONSTRAINT FK_1DB31BE2BF396750 FOREIGN KEY (id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE choix_personnage ADD CONSTRAINT FK_62CAEEDEE075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE choix_personnage ADD CONSTRAINT FK_62CAEEDE5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE compagnon ADD CONSTRAINT FK_63EA7766E7021F0E FOREIGN KEY (compagnon_type_id) REFERENCES compagnon_type (id)');
        $this->addSql('ALTER TABLE compagnon ADD CONSTRAINT FK_63EA77666E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63845446268 FOREIGN KEY (sujet_mail_id) REFERENCES sujet_mail (id)');
        $this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551F126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE guilde ADD CONSTRAINT FK_AEAB4047162F2AAE FOREIGN KEY (type_guilde_id) REFERENCES type_guilde (id)');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E06BB0AE84 FOREIGN KEY (items_id) REFERENCES inventaire_item (id)');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E05E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE inventaire_item ADD CONSTRAINT FK_D05778DBEC34F8ED FOREIGN KEY (types_des_id) REFERENCES type_des (id)');
        $this->addSql('ALTER TABLE inventaire_item ADD CONSTRAINT FK_D05778DB98D3FE22 FOREIGN KEY (monnaie_id) REFERENCES monnaie (id)');
        $this->addSql('ALTER TABLE inventaire_item ADD CONSTRAINT FK_D05778DBF915CFE FOREIGN KEY (fichier_id) REFERENCES fichier (id)');
        $this->addSql('ALTER TABLE inventaire_arme ADD CONSTRAINT FK_D76C2EBC49719342 FOREIGN KEY (type_arme_inventaire_id) REFERENCES type_arme (id)');
        $this->addSql('ALTER TABLE inventaire_arme ADD CONSTRAINT FK_D76C2EBC9BEEEF7C FOREIGN KEY (type_categorie_inventaire_id) REFERENCES type_categorie (id)');
        $this->addSql('ALTER TABLE inventaire_arme ADD CONSTRAINT FK_D76C2EBC1A7C3E96 FOREIGN KEY (materiel_inventaire_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE inventaire_arme ADD CONSTRAINT FK_D76C2EBCBF396750 FOREIGN KEY (id) REFERENCES inventaire_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventaire_armure ADD CONSTRAINT FK_E988043B5BCCA5EB FOREIGN KEY (equipement_inventaire_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE inventaire_armure ADD CONSTRAINT FK_E988043B10F2BEDF FOREIGN KEY (categorie_armure_inventaire_id) REFERENCES type_categorie (id)');
        $this->addSql('ALTER TABLE inventaire_armure ADD CONSTRAINT FK_E988043B17FB4E5A FOREIGN KEY (materiel_armure_inventaire_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE inventaire_armure ADD CONSTRAINT FK_E988043BBF396750 FOREIGN KEY (id) REFERENCES inventaire_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventaire_magie ADD CONSTRAINT FK_BA43679BF396750 FOREIGN KEY (id) REFERENCES inventaire_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventaire_magie_type_magie ADD CONSTRAINT FK_89826A2B65C66060 FOREIGN KEY (inventaire_magie_id) REFERENCES inventaire_magie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventaire_magie_type_magie ADD CONSTRAINT FK_89826A2BDAD93B63 FOREIGN KEY (type_magie_id) REFERENCES type_magie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A2E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A299E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE langue ADD CONSTRAINT FK_9357758E98260155 FOREIGN KEY (region_id) REFERENCES region_langue (id)');
        $this->addSql('ALTER TABLE langue_type_langue ADD CONSTRAINT FK_406E0DCDCEC86005 FOREIGN KEY (langue_type_id) REFERENCES langue_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE langue_type_langue ADD CONSTRAINT FK_406E0DCD2AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE magie ADD CONSTRAINT FK_E0654C1BBF396750 FOREIGN KEY (id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE magie_type_magie ADD CONSTRAINT FK_11577EBF17261C9F FOREIGN KEY (magie_id) REFERENCES magie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE magie_type_magie ADD CONSTRAINT FK_11577EBFDAD93B63 FOREIGN KEY (type_magie_id) REFERENCES type_magie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE niveau_metier ADD CONSTRAINT FK_F594AE13ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('ALTER TABLE niveau_metier ADD CONSTRAINT FK_F594AE135E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D6317D220 FOREIGN KEY (inventaire_bourse_id) REFERENCES inventaire_bourse (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe_personnage (id)');
        $this->addSql('ALTER TABLE personnage_langue ADD CONSTRAINT FK_55F1FF305E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnage_langue ADD CONSTRAINT FK_55F1FF302AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnage_compagnon ADD CONSTRAINT FK_52F3D2A65E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnage_compagnon ADD CONSTRAINT FK_52F3D2A6ABA9696 FOREIGN KEY (compagnon_id) REFERENCES compagnon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE race ADD CONSTRAINT FK_DA6FBBAF4678BBF8 FOREIGN KEY (type_race_id) REFERENCES type_race (id)');
        $this->addSql('ALTER TABLE rang_guilde ADD CONSTRAINT FK_7797BEBEA2E96BBE FOREIGN KEY (guilde_id) REFERENCES guilde (id)');
        $this->addSql('ALTER TABLE rang_guilde ADD CONSTRAINT FK_7797BEBE5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE talent ADD CONSTRAINT FK_16D902F5ACB13DFF FOREIGN KEY (type_talent_id) REFERENCES type_talent (id)');
        $this->addSql('ALTER TABLE valeur_caract ADD CONSTRAINT FK_F1E7E0161704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id)');
        $this->addSql('ALTER TABLE valeur_caract ADD CONSTRAINT FK_F1E7E0165E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE arme DROP FOREIGN KEY FK_18207379BF396750');
        $this->addSql('ALTER TABLE armure DROP FOREIGN KEY FK_4ADFC535BF396750');
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551F126F525E');
        $this->addSql('ALTER TABLE magie DROP FOREIGN KEY FK_E0654C1BBF396750');
        $this->addSql('ALTER TABLE capacite_racial_race DROP FOREIGN KEY FK_A5B6F9F896AF05A8');
        $this->addSql('ALTER TABLE caracteristique_principal DROP FOREIGN KEY FK_E761C0FBF396750');
        $this->addSql('ALTER TABLE caracteristique_secondaire DROP FOREIGN KEY FK_1DB31BE2BF396750');
        $this->addSql('ALTER TABLE valeur_caract DROP FOREIGN KEY FK_F1E7E0161704EEB7');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D8F5EA509');
        $this->addSql('ALTER TABLE personnage_compagnon DROP FOREIGN KEY FK_52F3D2A6ABA9696');
        $this->addSql('ALTER TABLE compagnon DROP FOREIGN KEY FK_63EA7766E7021F0E');
        $this->addSql('ALTER TABLE armure DROP FOREIGN KEY FK_4ADFC535806F0F5C');
        $this->addSql('ALTER TABLE inventaire_armure DROP FOREIGN KEY FK_E988043B5BCCA5EB');
        $this->addSql('ALTER TABLE inventaire_item DROP FOREIGN KEY FK_D05778DBF915CFE');
        $this->addSql('ALTER TABLE rang_guilde DROP FOREIGN KEY FK_7797BEBEA2E96BBE');
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E06BB0AE84');
        $this->addSql('ALTER TABLE inventaire_arme DROP FOREIGN KEY FK_D76C2EBCBF396750');
        $this->addSql('ALTER TABLE inventaire_armure DROP FOREIGN KEY FK_E988043BBF396750');
        $this->addSql('ALTER TABLE inventaire_magie DROP FOREIGN KEY FK_BA43679BF396750');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D6317D220');
        $this->addSql('ALTER TABLE inventaire_magie_type_magie DROP FOREIGN KEY FK_89826A2B65C66060');
        $this->addSql('ALTER TABLE langue_type_langue DROP FOREIGN KEY FK_406E0DCD2AADBACD');
        $this->addSql('ALTER TABLE personnage_langue DROP FOREIGN KEY FK_55F1FF302AADBACD');
        $this->addSql('ALTER TABLE langue_type_langue DROP FOREIGN KEY FK_406E0DCDCEC86005');
        $this->addSql('ALTER TABLE magie_type_magie DROP FOREIGN KEY FK_11577EBF17261C9F');
        $this->addSql('ALTER TABLE arme DROP FOREIGN KEY FK_1820737916880AAF');
        $this->addSql('ALTER TABLE armure DROP FOREIGN KEY FK_4ADFC53516880AAF');
        $this->addSql('ALTER TABLE inventaire_arme DROP FOREIGN KEY FK_D76C2EBC1A7C3E96');
        $this->addSql('ALTER TABLE inventaire_armure DROP FOREIGN KEY FK_E988043B17FB4E5A');
        $this->addSql('ALTER TABLE niveau_metier DROP FOREIGN KEY FK_F594AE13ED16FA20');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E98D3FE22');
        $this->addSql('ALTER TABLE inventaire_item DROP FOREIGN KEY FK_D05778DB98D3FE22');
        $this->addSql('ALTER TABLE choix_personnage DROP FOREIGN KEY FK_62CAEEDEE075F7A4');
        $this->addSql('ALTER TABLE invitation DROP FOREIGN KEY FK_F11D61A2E075F7A4');
        $this->addSql('ALTER TABLE choix_personnage DROP FOREIGN KEY FK_62CAEEDE5E315342');
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E05E315342');
        $this->addSql('ALTER TABLE niveau_metier DROP FOREIGN KEY FK_F594AE135E315342');
        $this->addSql('ALTER TABLE personnage_langue DROP FOREIGN KEY FK_55F1FF305E315342');
        $this->addSql('ALTER TABLE personnage_compagnon DROP FOREIGN KEY FK_52F3D2A65E315342');
        $this->addSql('ALTER TABLE rang_guilde DROP FOREIGN KEY FK_7797BEBE5E315342');
        $this->addSql('ALTER TABLE valeur_caract DROP FOREIGN KEY FK_F1E7E0165E315342');
        $this->addSql('ALTER TABLE capacite_racial_race DROP FOREIGN KEY FK_A5B6F9F86E59D40D');
        $this->addSql('ALTER TABLE compagnon DROP FOREIGN KEY FK_63EA77666E59D40D');
        $this->addSql('ALTER TABLE langue DROP FOREIGN KEY FK_9357758E98260155');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63845446268');
        $this->addSql('ALTER TABLE arme DROP FOREIGN KEY FK_182073792A3CF3FF');
        $this->addSql('ALTER TABLE inventaire_arme DROP FOREIGN KEY FK_D76C2EBC49719342');
        $this->addSql('ALTER TABLE arme DROP FOREIGN KEY FK_182073793BB65D28');
        $this->addSql('ALTER TABLE armure DROP FOREIGN KEY FK_4ADFC535BCF5E72D');
        $this->addSql('ALTER TABLE inventaire_arme DROP FOREIGN KEY FK_D76C2EBC9BEEEF7C');
        $this->addSql('ALTER TABLE inventaire_armure DROP FOREIGN KEY FK_E988043B10F2BEDF');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EB0286CBA');
        $this->addSql('ALTER TABLE inventaire_item DROP FOREIGN KEY FK_D05778DBEC34F8ED');
        $this->addSql('ALTER TABLE guilde DROP FOREIGN KEY FK_AEAB4047162F2AAE');
        $this->addSql('ALTER TABLE inventaire_magie_type_magie DROP FOREIGN KEY FK_89826A2BDAD93B63');
        $this->addSql('ALTER TABLE magie_type_magie DROP FOREIGN KEY FK_11577EBFDAD93B63');
        $this->addSql('ALTER TABLE race DROP FOREIGN KEY FK_DA6FBBAF4678BBF8');
        $this->addSql('ALTER TABLE talent DROP FOREIGN KEY FK_16D902F5ACB13DFF');
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551FA76ED395');
        $this->addSql('ALTER TABLE invitation DROP FOREIGN KEY FK_F11D61A299E6F5DF');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3DFB88E14F');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486DA76ED395');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE arme');
        $this->addSql('DROP TABLE armure');
        $this->addSql('DROP TABLE capacite_racial');
        $this->addSql('DROP TABLE capacite_racial_race');
        $this->addSql('DROP TABLE caracteristique');
        $this->addSql('DROP TABLE caracteristique_principal');
        $this->addSql('DROP TABLE caracteristique_secondaire');
        $this->addSql('DROP TABLE choix_personnage');
        $this->addSql('DROP TABLE classe_personnage');
        $this->addSql('DROP TABLE compagnon');
        $this->addSql('DROP TABLE compagnon_type');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE fichier');
        $this->addSql('DROP TABLE guilde');
        $this->addSql('DROP TABLE inventaire');
        $this->addSql('DROP TABLE inventaire_item');
        $this->addSql('DROP TABLE inventaire_arme');
        $this->addSql('DROP TABLE inventaire_armure');
        $this->addSql('DROP TABLE inventaire_bourse');
        $this->addSql('DROP TABLE inventaire_magie');
        $this->addSql('DROP TABLE inventaire_magie_type_magie');
        $this->addSql('DROP TABLE invitation');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE langue_type');
        $this->addSql('DROP TABLE langue_type_langue');
        $this->addSql('DROP TABLE magie');
        $this->addSql('DROP TABLE magie_type_magie');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE monnaie');
        $this->addSql('DROP TABLE niveau_metier');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE personnage');
        $this->addSql('DROP TABLE personnage_langue');
        $this->addSql('DROP TABLE personnage_compagnon');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE rang_guilde');
        $this->addSql('DROP TABLE region_langue');
        $this->addSql('DROP TABLE sujet_mail');
        $this->addSql('DROP TABLE talent');
        $this->addSql('DROP TABLE type_arme');
        $this->addSql('DROP TABLE type_categorie');
        $this->addSql('DROP TABLE type_des');
        $this->addSql('DROP TABLE type_guilde');
        $this->addSql('DROP TABLE type_magie');
        $this->addSql('DROP TABLE type_race');
        $this->addSql('DROP TABLE type_talent');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE valeur_caract');
    }
}
