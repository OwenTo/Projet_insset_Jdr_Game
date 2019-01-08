<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190108134644 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE talent (id INT AUTO_INCREMENT NOT NULL, description_talent LONGTEXT DEFAULT NULL, nom_talent VARCHAR(255) NOT NULL, benefice_maluce_talent LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_talent (id INT AUTO_INCREMENT NOT NULL, coll_talent_id INT DEFAULT NULL, nom_type_talent VARCHAR(255) NOT NULL, INDEX IDX_350E69CDC9734CAC (coll_talent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_talent ADD CONSTRAINT FK_350E69CDC9734CAC FOREIGN KEY (coll_talent_id) REFERENCES talent (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_talent DROP FOREIGN KEY FK_350E69CDC9734CAC');
        $this->addSql('DROP TABLE talent');
        $this->addSql('DROP TABLE type_talent');
    }
}
