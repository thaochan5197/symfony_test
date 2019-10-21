<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191024071315 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE organizations (id SERIAL NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_427C1C7FC54C8C93 ON organizations (type_id)');
        $this->addSql('CREATE TABLE fos_user (id SERIAL NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A647992FC23A8 ON fos_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479A0D96FBF ON fos_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479C05FB297 ON fos_user (confirmation_token)');
        $this->addSql('COMMENT ON COLUMN fos_user.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE organization_type (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE staffs (id SERIAL NOT NULL, organization_id INT DEFAULT NULL, position_id INT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_54D539032C8A3DE ON staffs (organization_id)');
        $this->addSql('CREATE INDEX IDX_54D5390DD842E46 ON staffs (position_id)');
        $this->addSql('CREATE INDEX IDX_54D5390A977936C ON staffs (tree_root)');
        $this->addSql('CREATE INDEX IDX_54D5390727ACA70 ON staffs (parent_id)');
        $this->addSql('CREATE TABLE position (id SERIAL NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_462CE4F5A977936C ON position (tree_root)');
        $this->addSql('CREATE INDEX IDX_462CE4F5727ACA70 ON position (parent_id)');
        $this->addSql('CREATE TABLE lexik_trans_unit_translations (id SERIAL NOT NULL, file_id INT DEFAULT NULL, trans_unit_id INT DEFAULT NULL, locale VARCHAR(10) NOT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, modified_manually BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B0AA394493CB796C ON lexik_trans_unit_translations (file_id)');
        $this->addSql('CREATE INDEX IDX_B0AA3944C3C583C9 ON lexik_trans_unit_translations (trans_unit_id)');
        $this->addSql('CREATE UNIQUE INDEX trans_unit_locale_idx ON lexik_trans_unit_translations (trans_unit_id, locale)');
        $this->addSql('CREATE TABLE lexik_translation_file (id SERIAL NOT NULL, domain VARCHAR(255) NOT NULL, locale VARCHAR(10) NOT NULL, extention VARCHAR(10) NOT NULL, path VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX hash_idx ON lexik_translation_file (hash)');
        $this->addSql('CREATE TABLE lexik_trans_unit (id SERIAL NOT NULL, key_name VARCHAR(255) NOT NULL, domain VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX key_domain_idx ON lexik_trans_unit (key_name, domain)');
        $this->addSql('ALTER TABLE organizations ADD CONSTRAINT FK_427C1C7FC54C8C93 FOREIGN KEY (type_id) REFERENCES organization_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staffs ADD CONSTRAINT FK_54D539032C8A3DE FOREIGN KEY (organization_id) REFERENCES organizations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staffs ADD CONSTRAINT FK_54D5390DD842E46 FOREIGN KEY (position_id) REFERENCES position (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staffs ADD CONSTRAINT FK_54D5390A977936C FOREIGN KEY (tree_root) REFERENCES staffs (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staffs ADD CONSTRAINT FK_54D5390727ACA70 FOREIGN KEY (parent_id) REFERENCES staffs (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F5A977936C FOREIGN KEY (tree_root) REFERENCES position (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F5727ACA70 FOREIGN KEY (parent_id) REFERENCES position (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lexik_trans_unit_translations ADD CONSTRAINT FK_B0AA394493CB796C FOREIGN KEY (file_id) REFERENCES lexik_translation_file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lexik_trans_unit_translations ADD CONSTRAINT FK_B0AA3944C3C583C9 FOREIGN KEY (trans_unit_id) REFERENCES lexik_trans_unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE staffs DROP CONSTRAINT FK_54D539032C8A3DE');
        $this->addSql('ALTER TABLE organizations DROP CONSTRAINT FK_427C1C7FC54C8C93');
        $this->addSql('ALTER TABLE staffs DROP CONSTRAINT FK_54D5390A977936C');
        $this->addSql('ALTER TABLE staffs DROP CONSTRAINT FK_54D5390727ACA70');
        $this->addSql('ALTER TABLE staffs DROP CONSTRAINT FK_54D5390DD842E46');
        $this->addSql('ALTER TABLE position DROP CONSTRAINT FK_462CE4F5A977936C');
        $this->addSql('ALTER TABLE position DROP CONSTRAINT FK_462CE4F5727ACA70');
        $this->addSql('ALTER TABLE lexik_trans_unit_translations DROP CONSTRAINT FK_B0AA394493CB796C');
        $this->addSql('ALTER TABLE lexik_trans_unit_translations DROP CONSTRAINT FK_B0AA3944C3C583C9');
        $this->addSql('DROP TABLE organizations');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE organization_type');
        $this->addSql('DROP TABLE staffs');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE lexik_trans_unit_translations');
        $this->addSql('DROP TABLE lexik_translation_file');
        $this->addSql('DROP TABLE lexik_trans_unit');
    }
}
