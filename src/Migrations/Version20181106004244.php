<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181106004244 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE answer DROP answer_date');
        $this->addSql('ALTER TABLE question DROP question_date');
        $this->addSql('ALTER TABLE user_account ALTER encoded_password DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE answer ADD answer_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE user_account ALTER encoded_password SET DEFAULT \'$2y$12$5k3JxMy1bQ7j5ixmHUwz/eDV6yM80ufXOptlduRt2lyWZuC3ZlLNK\'');
        $this->addSql('ALTER TABLE question ADD question_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
    }
}
