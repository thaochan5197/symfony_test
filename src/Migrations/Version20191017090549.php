<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191017090549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE staffs ADD tree_root INT DEFAULT NULL');
        $this->addSql('ALTER TABLE staffs ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE staffs ADD lft INT NOT NULL');
        $this->addSql('ALTER TABLE staffs ADD lvl INT NOT NULL');
        $this->addSql('ALTER TABLE staffs ADD rgt INT NOT NULL');
        $this->addSql('ALTER TABLE staffs ADD CONSTRAINT FK_54D5390A977936C FOREIGN KEY (tree_root) REFERENCES staffs (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staffs ADD CONSTRAINT FK_54D5390727ACA70 FOREIGN KEY (parent_id) REFERENCES staffs (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_54D5390A977936C ON staffs (tree_root)');
        $this->addSql('CREATE INDEX IDX_54D5390727ACA70 ON staffs (parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE staffs DROP CONSTRAINT FK_54D5390A977936C');
        $this->addSql('ALTER TABLE staffs DROP CONSTRAINT FK_54D5390727ACA70');
        $this->addSql('DROP INDEX IDX_54D5390A977936C');
        $this->addSql('DROP INDEX IDX_54D5390727ACA70');
        $this->addSql('ALTER TABLE staffs DROP tree_root');
        $this->addSql('ALTER TABLE staffs DROP parent_id');
        $this->addSql('ALTER TABLE staffs DROP lft');
        $this->addSql('ALTER TABLE staffs DROP lvl');
        $this->addSql('ALTER TABLE staffs DROP rgt');
    }
}
