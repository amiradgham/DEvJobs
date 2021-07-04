<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704194624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE postuler DROP FOREIGN KEY FK_8EC5A68DB03A8386');
        $this->addSql('ALTER TABLE postuler CHANGE created_by_id created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE postuler ADD CONSTRAINT FK_8EC5A68DB03A8386 FOREIGN KEY (created_by_id) REFERENCES informaticien (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE postuler DROP FOREIGN KEY FK_8EC5A68DB03A8386');
        $this->addSql('ALTER TABLE postuler CHANGE created_by_id created_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE postuler ADD CONSTRAINT FK_8EC5A68DB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
    }
}
