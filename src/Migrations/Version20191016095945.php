<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191016095945 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE staffs_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE organizations_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE position_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE organization_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE staffs (id INT NOT NULL, organization_id INT DEFAULT NULL, position_id INT NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_54D539032C8A3DE ON staffs (organization_id)');
        $this->addSql('CREATE INDEX IDX_54D5390DD842E46 ON staffs (position_id)');
        $this->addSql('CREATE TABLE organizations (id INT NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_427C1C7FC54C8C93 ON organizations (type_id)');
        $this->addSql('CREATE TABLE position (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE organization_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE staffs ADD CONSTRAINT FK_54D539032C8A3DE FOREIGN KEY (organization_id) REFERENCES organizations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staffs ADD CONSTRAINT FK_54D5390DD842E46 FOREIGN KEY (position_id) REFERENCES position (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE organizations ADD CONSTRAINT FK_427C1C7FC54C8C93 FOREIGN KEY (type_id) REFERENCES organization_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE staffs DROP CONSTRAINT FK_54D539032C8A3DE');
        $this->addSql('ALTER TABLE staffs DROP CONSTRAINT FK_54D5390DD842E46');
        $this->addSql('ALTER TABLE organizations DROP CONSTRAINT FK_427C1C7FC54C8C93');
        $this->addSql('DROP SEQUENCE staffs_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE organizations_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE position_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE organization_type_id_seq CASCADE');
        $this->addSql('DROP TABLE staffs');
        $this->addSql('DROP TABLE organizations');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE organization_type');
    }
}
