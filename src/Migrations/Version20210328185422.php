<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210328185422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE jobs_offers (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, created_by_id INT NOT NULL, update_by_id INT DEFAULT NULL, deleted_by_id INT DEFAULT NULL, name_offer VARCHAR(255) NOT NULL, description VARCHAR(550) NOT NULL, post_vacont INT NOT NULL, type VARCHAR(255) NOT NULL, experience VARCHAR(255) NOT NULL, experiation_date DATE NOT NULL, language VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, salary VARCHAR(255) DEFAULT NULL, contract_type VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, niveau_etude VARCHAR(255) DEFAULT NULL, mission LONGTEXT NOT NULL, formation_type VARCHAR(255) DEFAULT NULL, competence VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_17432326F92F3E70 (country_id), INDEX IDX_17432326B03A8386 (created_by_id), INDEX IDX_17432326CA83C286 (update_by_id), INDEX IDX_17432326C76F1F52 (deleted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jobs_offers ADD CONSTRAINT FK_17432326F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE jobs_offers ADD CONSTRAINT FK_17432326B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE jobs_offers ADD CONSTRAINT FK_17432326CA83C286 FOREIGN KEY (update_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE jobs_offers ADD CONSTRAINT FK_17432326C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE jobs_offers');
    }
}
