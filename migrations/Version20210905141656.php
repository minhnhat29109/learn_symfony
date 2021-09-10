<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210905141656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD author VARCHAR(255) DEFAULT NULL, ADD hert_count INT NOT NULL, ADD image_file_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E66989D9B62 ON article (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP INDEX UNIQ_23A0E66989D9B62 ON article');
        $this->addSql('ALTER TABLE article DROP author, DROP hert_count, DROP image_file_name');
    }
}
