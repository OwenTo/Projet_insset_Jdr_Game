<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190221101326 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE inventaire_magie (id INT NOT NULL, degat_magie_inventaire INT NOT NULL, cout_mana_magie_inventaire INT NOT NULL, niveau_magie_inventaire INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire_magie_type_magie (inventaire_magie_id INT NOT NULL, type_magie_id INT NOT NULL, INDEX IDX_89826A2B65C66060 (inventaire_magie_id), INDEX IDX_89826A2BDAD93B63 (type_magie_id), PRIMARY KEY(inventaire_magie_id, type_magie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventaire_magie ADD CONSTRAINT FK_BA43679BF396750 FOREIGN KEY (id) REFERENCES inventaire_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventaire_magie_type_magie ADD CONSTRAINT FK_89826A2B65C66060 FOREIGN KEY (inventaire_magie_id) REFERENCES inventaire_magie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventaire_magie_type_magie ADD CONSTRAINT FK_89826A2BDAD93B63 FOREIGN KEY (type_magie_id) REFERENCES type_magie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventaire_magie_type_magie DROP FOREIGN KEY FK_89826A2B65C66060');
        $this->addSql('DROP TABLE inventaire_magie');
        $this->addSql('DROP TABLE inventaire_magie_type_magie');
    }
}
