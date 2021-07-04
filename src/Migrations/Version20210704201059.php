<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704201059 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE postuler ADD offer_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE postuler ADD CONSTRAINT FK_8EC5A68DFC69E3BE FOREIGN KEY (offer_id_id) REFERENCES jobs_offers (id)');
        $this->addSql('CREATE INDEX IDX_8EC5A68DFC69E3BE ON postuler (offer_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE postuler DROP FOREIGN KEY FK_8EC5A68DFC69E3BE');
        $this->addSql('DROP INDEX IDX_8EC5A68DFC69E3BE ON postuler');
        $this->addSql('ALTER TABLE postuler DROP offer_id_id');
    }
}
