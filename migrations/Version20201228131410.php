<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201228131410 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recept (id INT AUTO_INCREMENT NOT NULL, medicijn_id INT NOT NULL, datum DATE NOT NULL, periode VARCHAR(255) NOT NULL, INDEX IDX_B92268A1DFC35CB (medicijn_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recept ADD CONSTRAINT FK_B92268A1DFC35CB FOREIGN KEY (medicijn_id) REFERENCES medicijn (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recept');
    }
}
