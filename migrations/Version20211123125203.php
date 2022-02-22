<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211123125203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE renter ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_887A3A1AE7927C74 ON renter (email)');
        $this->addSql('ALTER TABLE sleeper ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9080C247E7927C74 ON sleeper (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_887A3A1AE7927C74 ON renter');
        $this->addSql('ALTER TABLE renter DROP email, DROP roles, DROP password');
        $this->addSql('DROP INDEX UNIQ_9080C247E7927C74 ON sleeper');
        $this->addSql('ALTER TABLE sleeper DROP email, DROP roles, DROP password');
    }
}
