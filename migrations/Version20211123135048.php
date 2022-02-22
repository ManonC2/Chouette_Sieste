<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211123135048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bed DROP FOREIGN KEY FK_E647FCFFE289A545');
        $this->addSql('DROP INDEX IDX_E647FCFFE289A545 ON bed');
        $this->addSql('ALTER TABLE bed DROP renter_id');
        $this->addSql('ALTER TABLE user ADD type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bed ADD renter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bed ADD CONSTRAINT FK_E647FCFFE289A545 FOREIGN KEY (renter_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E647FCFFE289A545 ON bed (renter_id)');
        $this->addSql('ALTER TABLE user DROP type');
    }
}
