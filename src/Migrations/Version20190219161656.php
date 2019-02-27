<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190219161656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE personnage_compagnon (personnage_id INT NOT NULL, compagnon_id INT NOT NULL, INDEX IDX_52F3D2A65E315342 (personnage_id), INDEX IDX_52F3D2A6ABA9696 (compagnon_id), PRIMARY KEY(personnage_id, compagnon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnage_compagnon ADD CONSTRAINT FK_52F3D2A65E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnage_compagnon ADD CONSTRAINT FK_52F3D2A6ABA9696 FOREIGN KEY (compagnon_id) REFERENCES compagnon (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE compagnon_personnage');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compagnon_personnage (compagnon_id INT NOT NULL, personnage_id INT NOT NULL, INDEX IDX_5429D6A2ABA9696 (compagnon_id), INDEX IDX_5429D6A25E315342 (personnage_id), PRIMARY KEY(compagnon_id, personnage_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE compagnon_personnage ADD CONSTRAINT FK_5429D6A25E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compagnon_personnage ADD CONSTRAINT FK_5429D6A2ABA9696 FOREIGN KEY (compagnon_id) REFERENCES compagnon (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE personnage_compagnon');
    }
}
