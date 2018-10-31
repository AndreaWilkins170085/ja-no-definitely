<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181031190054 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE answer ALTER author_id TYPE INT');
        $this->addSql('ALTER TABLE answer ALTER author_id DROP DEFAULT');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25F675F31B FOREIGN KEY (author_id) REFERENCES user_account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DADD4A25F675F31B ON answer (author_id)');
        $this->addSql('ALTER TABLE question ALTER author_id TYPE INT');
        $this->addSql('ALTER TABLE question ALTER author_id DROP DEFAULT');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EF675F31B FOREIGN KEY (author_id) REFERENCES user_account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B6F7494EF675F31B ON question (author_id)');
        $this->addSql('ALTER TABLE user_account DROP password');
        $this->addSql('ALTER TABLE user_account ALTER encoded_password DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_account ADD password VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_account ALTER encoded_password SET DEFAULT \'$2y$12$5k3JxMy1bQ7j5ixmHUwz/eDV6yM80ufXOptlduRt2lyWZuC3ZlLNK\'');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494EF675F31B');
        $this->addSql('DROP INDEX IDX_B6F7494EF675F31B');
        $this->addSql('ALTER TABLE question ALTER author_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE question ALTER author_id DROP DEFAULT');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A25F675F31B');
        $this->addSql('DROP INDEX IDX_DADD4A25F675F31B');
        $this->addSql('ALTER TABLE answer ALTER author_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE answer ALTER author_id DROP DEFAULT');
    }
}
