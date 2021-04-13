<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210328180744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, created_id INT DEFAULT NULL, updated_id INT DEFAULT NULL, removed_id INT DEFAULT NULL, country_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', gender VARCHAR(50) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, user_type VARCHAR(55) NOT NULL, birth_date DATE DEFAULT NULL, session_timeout DATETIME DEFAULT NULL, zip_code VARCHAR(100) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, phone VARCHAR(100) DEFAULT NULL, multi_session TINYINT(1) DEFAULT NULL, language VARCHAR(2) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, removed_at DATETIME DEFAULT NULL, remove TINYINT(1) NOT NULL, qr_code VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), INDEX IDX_8D93D6495EE01E44 (created_id), INDEX IDX_8D93D649960CC7F3 (updated_id), INDEX IDX_8D93D649903F1AC9 (removed_id), INDEX IDX_8D93D649F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE translation (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT DEFAULT NULL, removed_by_id INT DEFAULT NULL, word VARCHAR(255) NOT NULL, en VARCHAR(255) DEFAULT NULL, fr VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, removed_at DATETIME DEFAULT NULL, remove TINYINT(1) NOT NULL, INDEX IDX_B469456FB03A8386 (created_by_id), INDEX IDX_B469456F896DBBDE (updated_by_id), INDEX IDX_B469456F2BD701DA (removed_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT DEFAULT NULL, removed_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, code VARCHAR(2) NOT NULL, long_code VARCHAR(3) DEFAULT NULL, prefix VARCHAR(6) DEFAULT NULL, enabled TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, removed_at DATETIME DEFAULT NULL, remove TINYINT(1) NOT NULL, INDEX IDX_5373C966B03A8386 (created_by_id), INDEX IDX_5373C966896DBBDE (updated_by_id), INDEX IDX_5373C9662BD701DA (removed_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT DEFAULT NULL, removed_by_id INT DEFAULT NULL, user_agent VARCHAR(255) NOT NULL, is_valide TINYINT(1) NOT NULL, ip_address VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, removed_at DATETIME DEFAULT NULL, removed TINYINT(1) NOT NULL, INDEX IDX_D044D5D4B03A8386 (created_by_id), INDEX IDX_D044D5D4896DBBDE (updated_by_id), INDEX IDX_D044D5D42BD701DA (removed_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, push_device_id_id INT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, removed_by_id INT DEFAULT NULL, recived_user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, body VARCHAR(255) NOT NULL, data VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, removed_at DATETIME DEFAULT NULL, removed TINYINT(1) NOT NULL, readed TINYINT(1) NOT NULL, INDEX IDX_BF5476CA4C2F2A10 (push_device_id_id), INDEX IDX_BF5476CAB03A8386 (created_by_id), INDEX IDX_BF5476CA896DBBDE (updated_by_id), INDEX IDX_BF5476CA2BD701DA (removed_by_id), INDEX IDX_BF5476CAE167033A (recived_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asset (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT DEFAULT NULL, removed_by_id INT DEFAULT NULL, text_value VARCHAR(255) NOT NULL, access VARCHAR(55) NOT NULL, type VARCHAR(255) NOT NULL, file_path VARCHAR(255) NOT NULL, file_type VARCHAR(100) NOT NULL, file_size VARCHAR(255) NOT NULL, duration INT DEFAULT NULL, resolution VARCHAR(100) DEFAULT NULL, enabled TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, removed_at DATETIME DEFAULT NULL, remove TINYINT(1) NOT NULL, INDEX IDX_2AF5A5CB03A8386 (created_by_id), INDEX IDX_2AF5A5C896DBBDE (updated_by_id), INDEX IDX_2AF5A5C2BD701DA (removed_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE device (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, removed_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, os VARCHAR(100) NOT NULL, version VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, uuid VARCHAR(255) NOT NULL, position VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, removed_at DATETIME DEFAULT NULL, removed TINYINT(1) NOT NULL, INDEX IDX_92FB68EB03A8386 (created_by_id), INDEX IDX_92FB68E2BD701DA (removed_by_id), INDEX IDX_92FB68E896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495EE01E44 FOREIGN KEY (created_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649960CC7F3 FOREIGN KEY (updated_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649903F1AC9 FOREIGN KEY (removed_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456FB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456F896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456F2BD701DA FOREIGN KEY (removed_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C9662BD701DA FOREIGN KEY (removed_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D42BD701DA FOREIGN KEY (removed_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA4C2F2A10 FOREIGN KEY (push_device_id_id) REFERENCES device (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA2BD701DA FOREIGN KEY (removed_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAE167033A FOREIGN KEY (recived_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5CB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5C896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5C2BD701DA FOREIGN KEY (removed_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68EB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68E2BD701DA FOREIGN KEY (removed_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495EE01E44');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649960CC7F3');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649903F1AC9');
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456FB03A8386');
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456F896DBBDE');
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456F2BD701DA');
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966B03A8386');
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966896DBBDE');
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C9662BD701DA');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4B03A8386');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4896DBBDE');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D42BD701DA');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAB03A8386');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA896DBBDE');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA2BD701DA');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAE167033A');
        $this->addSql('ALTER TABLE asset DROP FOREIGN KEY FK_2AF5A5CB03A8386');
        $this->addSql('ALTER TABLE asset DROP FOREIGN KEY FK_2AF5A5C896DBBDE');
        $this->addSql('ALTER TABLE asset DROP FOREIGN KEY FK_2AF5A5C2BD701DA');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68EB03A8386');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68E2BD701DA');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68E896DBBDE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F92F3E70');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA4C2F2A10');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE translation');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE asset');
        $this->addSql('DROP TABLE device');
        $this->addSql('DROP TABLE refresh_tokens');
    }
}
