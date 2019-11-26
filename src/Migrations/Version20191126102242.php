<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126102242 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE chat_user_by_campagne (chat_id INT NOT NULL, user_by_campagne_id INT NOT NULL, INDEX IDX_AE4621C71A9A7125 (chat_id), INDEX IDX_AE4621C7D9A69C93 (user_by_campagne_id), PRIMARY KEY(chat_id, user_by_campagne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chat_user_by_campagne ADD CONSTRAINT FK_AE4621C71A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chat_user_by_campagne ADD CONSTRAINT FK_AE4621C7D9A69C93 FOREIGN KEY (user_by_campagne_id) REFERENCES user_by_campagne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chat ADD text LONGTEXT NOT NULL, ADD datetime DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE stat ADD id_user_id INT NOT NULL, ADD communication DOUBLE PRECISION NOT NULL, ADD critical_thinking DOUBLE PRECISION NOT NULL, ADD leadership DOUBLE PRECISION NOT NULL, ADD positive_attitude DOUBLE PRECISION NOT NULL, ADD team_work DOUBLE PRECISION NOT NULL, ADD work_ethic DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE stat ADD CONSTRAINT FK_20B8FF2179F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_20B8FF2179F37AE5 ON stat (id_user_id)');
        $this->addSql('ALTER TABLE user_by_campagne ADD id_campagne_id INT NOT NULL, ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_by_campagne ADD CONSTRAINT FK_5B2AF50AE30BE83 FOREIGN KEY (id_campagne_id) REFERENCES campagne (id)');
        $this->addSql('ALTER TABLE user_by_campagne ADD CONSTRAINT FK_5B2AF50A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5B2AF50AE30BE83 ON user_by_campagne (id_campagne_id)');
        $this->addSql('CREATE INDEX IDX_5B2AF50A79F37AE5 ON user_by_campagne (id_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE chat_user_by_campagne');
        $this->addSql('ALTER TABLE chat DROP text, DROP datetime');
        $this->addSql('ALTER TABLE stat DROP FOREIGN KEY FK_20B8FF2179F37AE5');
        $this->addSql('DROP INDEX UNIQ_20B8FF2179F37AE5 ON stat');
        $this->addSql('ALTER TABLE stat DROP id_user_id, DROP communication, DROP critical_thinking, DROP leadership, DROP positive_attitude, DROP team_work, DROP work_ethic');
        $this->addSql('ALTER TABLE user DROP email, DROP nom, DROP prenom');
        $this->addSql('ALTER TABLE user_by_campagne DROP FOREIGN KEY FK_5B2AF50AE30BE83');
        $this->addSql('ALTER TABLE user_by_campagne DROP FOREIGN KEY FK_5B2AF50A79F37AE5');
        $this->addSql('DROP INDEX IDX_5B2AF50AE30BE83 ON user_by_campagne');
        $this->addSql('DROP INDEX IDX_5B2AF50A79F37AE5 ON user_by_campagne');
        $this->addSql('ALTER TABLE user_by_campagne DROP id_campagne_id, DROP id_user_id');
    }
}
