<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628174556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address_postal (id INT AUTO_INCREMENT NOT NULL, addresse VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address_postal_user (address_postal_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7D1266C84B1D621 (address_postal_id), INDEX IDX_7D1266CA76ED395 (user_id), PRIMARY KEY(address_postal_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address_postal_user ADD CONSTRAINT FK_7D1266C84B1D621 FOREIGN KEY (address_postal_id) REFERENCES address_postal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE address_postal_user ADD CONSTRAINT FK_7D1266CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address_postal_user DROP FOREIGN KEY FK_7D1266C84B1D621');
        $this->addSql('DROP TABLE address_postal');
        $this->addSql('DROP TABLE address_postal_user');
    }
}
