<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191017091944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE "position" ADD tree_root INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "position" ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "position" ADD lft INT NOT NULL');
        $this->addSql('ALTER TABLE "position" ADD lvl INT NOT NULL');
        $this->addSql('ALTER TABLE "position" ADD rgt INT NOT NULL');
        $this->addSql('ALTER TABLE "position" ADD CONSTRAINT FK_462CE4F5A977936C FOREIGN KEY (tree_root) REFERENCES position (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "position" ADD CONSTRAINT FK_462CE4F5727ACA70 FOREIGN KEY (parent_id) REFERENCES position (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_462CE4F5A977936C ON "position" (tree_root)');
        $this->addSql('CREATE INDEX IDX_462CE4F5727ACA70 ON "position" (parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE position DROP CONSTRAINT FK_462CE4F5A977936C');
        $this->addSql('ALTER TABLE position DROP CONSTRAINT FK_462CE4F5727ACA70');
        $this->addSql('DROP INDEX IDX_462CE4F5A977936C');
        $this->addSql('DROP INDEX IDX_462CE4F5727ACA70');
        $this->addSql('ALTER TABLE position DROP tree_root');
        $this->addSql('ALTER TABLE position DROP parent_id');
        $this->addSql('ALTER TABLE position DROP lft');
        $this->addSql('ALTER TABLE position DROP lvl');
        $this->addSql('ALTER TABLE position DROP rgt');
    }
}
