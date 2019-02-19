<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190219161256 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compagnon_personnage (compagnon_id INT NOT NULL, personnage_id INT NOT NULL, INDEX IDX_5429D6A2ABA9696 (compagnon_id), INDEX IDX_5429D6A25E315342 (personnage_id), PRIMARY KEY(compagnon_id, personnage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compagnon_personnage ADD CONSTRAINT FK_5429D6A2ABA9696 FOREIGN KEY (compagnon_id) REFERENCES compagnon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compagnon_personnage ADD CONSTRAINT FK_5429D6A25E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compagnon DROP FOREIGN KEY FK_63EA77665E315342');
        $this->addSql('DROP INDEX IDX_63EA77665E315342 ON compagnon');
        $this->addSql('ALTER TABLE compagnon DROP personnage_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE compagnon_personnage');
        $this->addSql('ALTER TABLE compagnon ADD personnage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compagnon ADD CONSTRAINT FK_63EA77665E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('CREATE INDEX IDX_63EA77665E315342 ON compagnon (personnage_id)');
    }
}
