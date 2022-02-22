<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211123125812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE renter ADD name VARCHAR(255) NOT NULL, ADD surname VARCHAR(255) NOT NULL, ADD adress VARCHAR(255) NOT NULL, ADD zipcode INT NOT NULL, ADD town VARCHAR(255) NOT NULL, ADD phone VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE sleeper ADD name VARCHAR(255) NOT NULL, ADD surname VARCHAR(255) NOT NULL, ADD adress VARCHAR(255) NOT NULL, ADD zipcode INT NOT NULL, ADD town VARCHAR(255) NOT NULL, ADD phone VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL, ADD surname VARCHAR(255) NOT NULL, ADD adress VARCHAR(255) NOT NULL, ADD zipcode INT NOT NULL, ADD town VARCHAR(255) NOT NULL, ADD phone VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE renter DROP name, DROP surname, DROP adress, DROP zipcode, DROP town, DROP phone');
        $this->addSql('ALTER TABLE sleeper DROP name, DROP surname, DROP adress, DROP zipcode, DROP town, DROP phone');
        $this->addSql('ALTER TABLE user DROP name, DROP surname, DROP adress, DROP zipcode, DROP town, DROP phone');
    }
}
