<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190122161509 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE armure CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE armure ADD CONSTRAINT FK_4ADFC535BCF5E72D FOREIGN KEY (categorie_id) REFERENCES type_categorie (id)');
        $this->addSql('ALTER TABLE armure ADD CONSTRAINT FK_4ADFC535BF396750 FOREIGN KEY (id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_4ADFC535BCF5E72D ON armure (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE armure DROP FOREIGN KEY FK_4ADFC535BCF5E72D');
        $this->addSql('ALTER TABLE armure DROP FOREIGN KEY FK_4ADFC535BF396750');
        $this->addSql('DROP INDEX IDX_4ADFC535BCF5E72D ON armure');
        $this->addSql('ALTER TABLE armure CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
