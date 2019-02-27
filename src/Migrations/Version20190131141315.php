<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190131141315 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_talent DROP FOREIGN KEY FK_350E69CDC9734CAC');
        $this->addSql('DROP INDEX IDX_350E69CDC9734CAC ON type_talent');
        $this->addSql('ALTER TABLE type_talent DROP coll_talent_id');
        $this->addSql('ALTER TABLE talent ADD type_talent_id INT NOT NULL');
        $this->addSql('ALTER TABLE talent ADD CONSTRAINT FK_16D902F5ACB13DFF FOREIGN KEY (type_talent_id) REFERENCES type_talent (id)');
        $this->addSql('CREATE INDEX IDX_16D902F5ACB13DFF ON talent (type_talent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE talent DROP FOREIGN KEY FK_16D902F5ACB13DFF');
        $this->addSql('DROP INDEX IDX_16D902F5ACB13DFF ON talent');
        $this->addSql('ALTER TABLE talent DROP type_talent_id');
        $this->addSql('ALTER TABLE type_talent ADD coll_talent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_talent ADD CONSTRAINT FK_350E69CDC9734CAC FOREIGN KEY (coll_talent_id) REFERENCES talent (id)');
        $this->addSql('CREATE INDEX IDX_350E69CDC9734CAC ON type_talent (coll_talent_id)');
    }
}
