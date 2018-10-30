<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181030105105 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE answer ALTER question_id DROP NOT NULL');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('ALTER TABLE question ALTER category_id DROP NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B6F7494E12469DE2 ON question (category_id)');
        $this->addSql('ALTER TABLE user_account ADD encoded_password VARCHAR(255) DEFAULT \'$2y$12$5k3JxMy1bQ7j5ixmHUwz/eDV6yM80ufXOptlduRt2lyWZuC3ZlLNK\' NOT NULL');
        $this->addSql('ALTER TABLE user_account DROP password');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A251E27F6BF');
        $this->addSql('DROP INDEX IDX_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE answer ALTER question_id SET NOT NULL');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494E12469DE2');
        $this->addSql('DROP INDEX IDX_B6F7494E12469DE2');
        $this->addSql('ALTER TABLE question ALTER category_id SET NOT NULL');
        $this->addSql('ALTER TABLE user_account ADD password VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_account DROP encoded_password');
    }
}
