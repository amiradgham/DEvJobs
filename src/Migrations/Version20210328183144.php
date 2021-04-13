<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210328183144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE training_post (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, modalite VARCHAR(255) DEFAULT NULL, objectif VARCHAR(255) NOT NULL, hourly_volume VARCHAR(50) NOT NULL, cout VARCHAR(55) NOT NULL, service_telephone VARCHAR(255) DEFAULT NULL, service_gsm VARCHAR(255) DEFAULT NULL, service_email VARCHAR(255) DEFAULT NULL, service_site_web VARCHAR(255) DEFAULT NULL, secteur VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) NOT NULL, adddress VARCHAR(255) DEFAULT NULL, end_duration DATE DEFAULT NULL, society_description VARCHAR(550) DEFAULT NULL, INDEX IDX_55102BCEF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE training_post ADD CONSTRAINT FK_55102BCEF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE training_post');
    }
}
