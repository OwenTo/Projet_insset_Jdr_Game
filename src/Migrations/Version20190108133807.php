<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190108133807 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom_equipement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, type_materiel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item ADD type_des_id INT DEFAULT NULL, ADD monnaie_id INT DEFAULT NULL, CHANGE discr enfant VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EB0286CBA FOREIGN KEY (type_des_id) REFERENCES type_des (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E98D3FE22 FOREIGN KEY (monnaie_id) REFERENCES monnaie (id)');
        $this->addSql('CREATE INDEX IDX_1F1B251EB0286CBA ON item (type_des_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E98D3FE22 ON item (monnaie_id)');
        $this->addSql('ALTER TABLE arme ADD materiel_id INT DEFAULT NULL, CHANGE degat degat INT NOT NULL');
        $this->addSql('ALTER TABLE arme ADD CONSTRAINT FK_1820737916880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('CREATE INDEX IDX_1820737916880AAF ON arme (materiel_id)');
        $this->addSql('ALTER TABLE armure ADD materiel_id INT DEFAULT NULL, ADD equipement_id INT DEFAULT NULL, CHANGE defense defense INT NOT NULL');
        $this->addSql('ALTER TABLE armure ADD CONSTRAINT FK_4ADFC53516880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE armure ADD CONSTRAINT FK_4ADFC535806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('CREATE INDEX IDX_4ADFC53516880AAF ON armure (materiel_id)');
        $this->addSql('CREATE INDEX IDX_4ADFC535806F0F5C ON armure (equipement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE armure DROP FOREIGN KEY FK_4ADFC535806F0F5C');
        $this->addSql('ALTER TABLE arme DROP FOREIGN KEY FK_1820737916880AAF');
        $this->addSql('ALTER TABLE armure DROP FOREIGN KEY FK_4ADFC53516880AAF');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP INDEX IDX_1820737916880AAF ON arme');
        $this->addSql('ALTER TABLE arme DROP materiel_id, CHANGE degat degat VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX IDX_4ADFC53516880AAF ON armure');
        $this->addSql('DROP INDEX IDX_4ADFC535806F0F5C ON armure');
        $this->addSql('ALTER TABLE armure DROP materiel_id, DROP equipement_id, CHANGE defense defense VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EB0286CBA');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E98D3FE22');
        $this->addSql('DROP INDEX IDX_1F1B251EB0286CBA ON item');
        $this->addSql('DROP INDEX IDX_1F1B251E98D3FE22 ON item');
        $this->addSql('ALTER TABLE item DROP type_des_id, DROP monnaie_id, CHANGE enfant discr VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
