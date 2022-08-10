<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220810070157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phone ADD accessories TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE phone RENAME INDEX manufacturer_idx TO IDX_444F97DDA23B42D');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phone DROP accessories');
        $this->addSql('ALTER TABLE phone RENAME INDEX idx_444f97dda23b42d TO manufacturer_idx');
    }
}
