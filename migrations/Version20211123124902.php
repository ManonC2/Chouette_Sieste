<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211123124902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bed (id INT AUTO_INCREMENT NOT NULL, renter_id INT NOT NULL, le_type_matress_id INT DEFAULT NULL, le_type_topper_matress_id INT DEFAULT NULL, INDEX IDX_E647FCFFE289A545 (renter_id), INDEX IDX_E647FCFF4EA68496 (le_type_matress_id), INDEX IDX_E647FCFFECFE83A6 (le_type_topper_matress_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE renter (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sleeper (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slot (id INT AUTO_INCREMENT NOT NULL, sleeper_id INT DEFAULT NULL, INDEX IDX_AC0E20677E06809 (sleeper_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_matress (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_topper_matress (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bed ADD CONSTRAINT FK_E647FCFFE289A545 FOREIGN KEY (renter_id) REFERENCES renter (id)');
        $this->addSql('ALTER TABLE bed ADD CONSTRAINT FK_E647FCFF4EA68496 FOREIGN KEY (le_type_matress_id) REFERENCES type_matress (id)');
        $this->addSql('ALTER TABLE bed ADD CONSTRAINT FK_E647FCFFECFE83A6 FOREIGN KEY (le_type_topper_matress_id) REFERENCES type_topper_matress (id)');
        $this->addSql('ALTER TABLE slot ADD CONSTRAINT FK_AC0E20677E06809 FOREIGN KEY (sleeper_id) REFERENCES sleeper (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bed DROP FOREIGN KEY FK_E647FCFFE289A545');
        $this->addSql('ALTER TABLE slot DROP FOREIGN KEY FK_AC0E20677E06809');
        $this->addSql('ALTER TABLE bed DROP FOREIGN KEY FK_E647FCFF4EA68496');
        $this->addSql('ALTER TABLE bed DROP FOREIGN KEY FK_E647FCFFECFE83A6');
        $this->addSql('DROP TABLE bed');
        $this->addSql('DROP TABLE renter');
        $this->addSql('DROP TABLE sleeper');
        $this->addSql('DROP TABLE slot');
        $this->addSql('DROP TABLE type_matress');
        $this->addSql('DROP TABLE type_topper_matress');
        $this->addSql('DROP TABLE user');
    }
}
