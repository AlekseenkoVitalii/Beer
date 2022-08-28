<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220827134804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE beer (id INT NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_58F666ADC54C8C93 ON beer (type_id)');
        $this->addSql('CREATE TABLE beer_supplier (beer_id INT NOT NULL, supplier_id INT NOT NULL, PRIMARY KEY(beer_id, supplier_id))');
        $this->addSql('CREATE INDEX IDX_51F660E0D0989053 ON beer_supplier (beer_id)');
        $this->addSql('CREATE INDEX IDX_51F660E02ADD6D8C ON beer_supplier (supplier_id)');
        $this->addSql('CREATE TABLE supplier (id INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_beer (id INT NOT NULL, type VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE beer ADD CONSTRAINT FK_58F666ADC54C8C93 FOREIGN KEY (type_id) REFERENCES type_beer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE beer_supplier ADD CONSTRAINT FK_51F660E0D0989053 FOREIGN KEY (beer_id) REFERENCES beer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE beer_supplier ADD CONSTRAINT FK_51F660E02ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE beer DROP CONSTRAINT FK_58F666ADC54C8C93');
        $this->addSql('ALTER TABLE beer_supplier DROP CONSTRAINT FK_51F660E0D0989053');
        $this->addSql('ALTER TABLE beer_supplier DROP CONSTRAINT FK_51F660E02ADD6D8C');
        $this->addSql('DROP TABLE beer');
        $this->addSql('DROP TABLE beer_supplier');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE type_beer');
    }
}
