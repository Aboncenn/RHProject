<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191125175751 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat_user_by_campagne DROP FOREIGN KEY FK_AE4621C71A9A7125');
        $this->addSql('ALTER TABLE stat DROP FOREIGN KEY FK_20B8FF2179F37AE5');
        $this->addSql('ALTER TABLE user_by_campagne DROP FOREIGN KEY FK_5B2AF50A79F37AE5');
        $this->addSql('ALTER TABLE chat_user_by_campagne DROP FOREIGN KEY FK_AE4621C7D9A69C93');
        $this->addSql('ALTER TABLE user_by_campagne DROP FOREIGN KEY FK_5B2AF50AE30BE83');
        $this->addSql('DROP TABLE user');
    }
}
