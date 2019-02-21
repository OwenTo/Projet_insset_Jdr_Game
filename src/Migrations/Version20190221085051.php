<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190221085051 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE inventaire_item (id INT AUTO_INCREMENT NOT NULL, types_des_id INT DEFAULT NULL, monnaie_id INT DEFAULT NULL, fichier_id INT DEFAULT NULL, nom_item_inventaire VARCHAR(255) NOT NULL, description_item_inventaire LONGTEXT DEFAULT NULL, poids_item_inventaire DOUBLE PRECISION DEFAULT NULL, benefice_maluce_inventaire LONGTEXT DEFAULT NULL, valeur_inventaire INT NOT NULL, INDEX IDX_D05778DBEC34F8ED (types_des_id), INDEX IDX_D05778DB98D3FE22 (monnaie_id), UNIQUE INDEX UNIQ_D05778DBF915CFE (fichier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventaire_item ADD CONSTRAINT FK_D05778DBEC34F8ED FOREIGN KEY (types_des_id) REFERENCES type_des (id)');
        $this->addSql('ALTER TABLE inventaire_item ADD CONSTRAINT FK_D05778DB98D3FE22 FOREIGN KEY (monnaie_id) REFERENCES monnaie (id)');
        $this->addSql('ALTER TABLE inventaire_item ADD CONSTRAINT FK_D05778DBF915CFE FOREIGN KEY (fichier_id) REFERENCES fichier (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE inventaire_item');
    }
}