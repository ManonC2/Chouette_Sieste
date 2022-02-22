<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211201184342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slot ADD the_bed_id INT NOT NULL, ADD date DATE NOT NULL, ADD time TIME NOT NULL');
        $this->addSql('ALTER TABLE slot ADD CONSTRAINT FK_AC0E20678FAF73B3 FOREIGN KEY (the_bed_id) REFERENCES bed (id)');
        $this->addSql('CREATE INDEX IDX_AC0E20678FAF73B3 ON slot (the_bed_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slot DROP FOREIGN KEY FK_AC0E20678FAF73B3');
        $this->addSql('DROP INDEX IDX_AC0E20678FAF73B3 ON slot');
        $this->addSql('ALTER TABLE slot DROP the_bed_id, DROP date, DROP time');
    }
}
