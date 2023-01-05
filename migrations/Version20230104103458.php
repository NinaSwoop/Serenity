<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104103458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD secretariat_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A628C492 FOREIGN KEY (secretariat_id) REFERENCES secretariat (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649A628C492 ON user (secretariat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A628C492');
        $this->addSql('DROP INDEX IDX_8D93D649A628C492 ON user');
        $this->addSql('ALTER TABLE user DROP secretariat_id');
    }
}
