<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210628205511 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sector (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, deleted_by_id INT DEFAULT NULL, sector_name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_4BA3D9E8B03A8386 (created_by_id), INDEX IDX_4BA3D9E8896DBBDE (updated_by_id), INDEX IDX_4BA3D9E8C76F1F52 (deleted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_offer (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT DEFAULT NULL, removed_by_id INT DEFAULT NULL, sector_id INT DEFAULT NULL, traning_name VARCHAR(50) NOT NULL, training_description VARCHAR(255) NOT NULL, training_modality VARCHAR(50) DEFAULT NULL, training_objectif VARCHAR(255) DEFAULT NULL, hourly_volume VARCHAR(50) DEFAULT NULL, traning_cost VARCHAR(50) DEFAULT NULL, city VARCHAR(50) NOT NULL, address VARCHAR(50) DEFAULT NULL, training_duration VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, remove TINYINT(1) NOT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_C60C0D53B03A8386 (created_by_id), INDEX IDX_C60C0D53896DBBDE (updated_by_id), INDEX IDX_C60C0D532BD701DA (removed_by_id), INDEX IDX_C60C0D53DE95C867 (sector_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sector ADD CONSTRAINT FK_4BA3D9E8B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sector ADD CONSTRAINT FK_4BA3D9E8896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sector ADD CONSTRAINT FK_4BA3D9E8C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE training_offer ADD CONSTRAINT FK_C60C0D53B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE training_offer ADD CONSTRAINT FK_C60C0D53896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE training_offer ADD CONSTRAINT FK_C60C0D532BD701DA FOREIGN KEY (removed_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE training_offer ADD CONSTRAINT FK_C60C0D53DE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id)');
        $this->addSql('ALTER TABLE jobs_offers ADD remove TINYINT(1) DEFAULT NULL, ADD picture VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE training_offer DROP FOREIGN KEY FK_C60C0D53DE95C867');
        $this->addSql('DROP TABLE sector');
        $this->addSql('DROP TABLE training_offer');
        $this->addSql('ALTER TABLE jobs_offers DROP remove, DROP picture');
    }
}
