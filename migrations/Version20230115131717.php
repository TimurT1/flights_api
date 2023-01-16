<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230115131717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE company_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE flight_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE company (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE flight (id INT NOT NULL, company_id INT NOT NULL, flight_number VARCHAR(10) NOT NULL, destination VARCHAR(50) NOT NULL, departure TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, gate VARCHAR(5) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C257E60E979B1AD6 ON flight (company_id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE company_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE flight_id_seq CASCADE');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E979B1AD6');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE flight');
    }
}
