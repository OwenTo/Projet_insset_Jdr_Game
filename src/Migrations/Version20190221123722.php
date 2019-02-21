<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190221123722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE magie_type_magie (magie_id INT NOT NULL, type_magie_id INT NOT NULL, INDEX IDX_11577EBF17261C9F (magie_id), INDEX IDX_11577EBFDAD93B63 (type_magie_id), PRIMARY KEY(magie_id, type_magie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE magie_type_magie ADD CONSTRAINT FK_11577EBF17261C9F FOREIGN KEY (magie_id) REFERENCES magie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE magie_type_magie ADD CONSTRAINT FK_11577EBFDAD93B63 FOREIGN KEY (type_magie_id) REFERENCES type_magie (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE type_magie_magie');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type_magie_magie (type_magie_id INT NOT NULL, magie_id INT NOT NULL, INDEX IDX_704CE797DAD93B63 (type_magie_id), INDEX IDX_704CE79717261C9F (magie_id), PRIMARY KEY(type_magie_id, magie_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE type_magie_magie ADD CONSTRAINT FK_704CE79717261C9F FOREIGN KEY (magie_id) REFERENCES magie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_magie_magie ADD CONSTRAINT FK_704CE797DAD93B63 FOREIGN KEY (type_magie_id) REFERENCES type_magie (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE magie_type_magie');
    }
}
