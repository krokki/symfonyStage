<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220816075105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE geolocation_cache (
                        ip VARCHAR(15) NOT NULL, 
                        id INT NOT NULL,
                        geolocation JSON NOT NULL, 
                        created_at DATETIME NOT NULL,
                        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE geolocation_cache ADD UNIQUE INDEX idx_ip (ip)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX idx_ip ON geolocation_cache');
        $this->addSql('DROP TABLE geolocation_cache');
    }
}
