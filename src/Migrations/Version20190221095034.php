<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190221095034 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486DCE430A85');
        $this->addSql('CREATE TABLE inventaire_item (id INT AUTO_INCREMENT NOT NULL, types_des_id INT DEFAULT NULL, monnaie_id INT DEFAULT NULL, fichier_id INT DEFAULT NULL, nom_item_inventaire VARCHAR(255) NOT NULL, description_item_inventaire LONGTEXT DEFAULT NULL, poids_item_inventaire DOUBLE PRECISION DEFAULT NULL, benefice_maluce_inventaire LONGTEXT DEFAULT NULL, valeur_inventaire INT NOT NULL, enfant VARCHAR(255) NOT NULL, INDEX IDX_D05778DBEC34F8ED (types_des_id), INDEX IDX_D05778DB98D3FE22 (monnaie_id), UNIQUE INDEX UNIQ_D05778DBF915CFE (fichier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire_arme (id INT NOT NULL, type_arme_inventaire_id INT DEFAULT NULL, type_categorie_inventaire_id INT DEFAULT NULL, materiel_inventaire_id INT DEFAULT NULL, degat_arme_inventaire INT NOT NULL, INDEX IDX_D76C2EBC49719342 (type_arme_inventaire_id), INDEX IDX_D76C2EBC9BEEEF7C (type_categorie_inventaire_id), INDEX IDX_D76C2EBC1A7C3E96 (materiel_inventaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventaire_item ADD CONSTRAINT FK_D05778DBEC34F8ED FOREIGN KEY (types_des_id) REFERENCES type_des (id)');
        $this->addSql('ALTER TABLE inventaire_item ADD CONSTRAINT FK_D05778DB98D3FE22 FOREIGN KEY (monnaie_id) REFERENCES monnaie (id)');
        $this->addSql('ALTER TABLE inventaire_item ADD CONSTRAINT FK_D05778DBF915CFE FOREIGN KEY (fichier_id) REFERENCES fichier (id)');
        $this->addSql('ALTER TABLE inventaire_arme ADD CONSTRAINT FK_D76C2EBC49719342 FOREIGN KEY (type_arme_inventaire_id) REFERENCES type_arme (id)');
        $this->addSql('ALTER TABLE inventaire_arme ADD CONSTRAINT FK_D76C2EBC9BEEEF7C FOREIGN KEY (type_categorie_inventaire_id) REFERENCES type_categorie (id)');
        $this->addSql('ALTER TABLE inventaire_arme ADD CONSTRAINT FK_D76C2EBC1A7C3E96 FOREIGN KEY (materiel_inventaire_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE inventaire_arme ADD CONSTRAINT FK_D76C2EBCBF396750 FOREIGN KEY (id) REFERENCES inventaire_item (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE inventaire');
        $this->addSql('DROP INDEX UNIQ_6AEA486DCE430A85 ON personnage');
        $this->addSql('ALTER TABLE personnage DROP inventaire_id');
        $this->addSql('ALTER TABLE inventaire_armure ADD CONSTRAINT FK_E988043BBF396750 FOREIGN KEY (id) REFERENCES inventaire_item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventaire_arme DROP FOREIGN KEY FK_D76C2EBCBF396750');
        $this->addSql('ALTER TABLE inventaire_armure DROP FOREIGN KEY FK_E988043BBF396750');
        $this->addSql('CREATE TABLE inventaire (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE inventaire_item');
        $this->addSql('DROP TABLE inventaire_arme');
        $this->addSql('ALTER TABLE personnage ADD inventaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486DCE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AEA486DCE430A85 ON personnage (inventaire_id)');
    }
}