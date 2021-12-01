<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211120162719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE magasin (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, capacite INT NOT NULL, localisation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, prix INT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_magasin (produit_id INT NOT NULL, magasin_id INT NOT NULL, INDEX IDX_9254D45EF347EFB (produit_id), INDEX IDX_9254D45E20096AE3 (magasin_id), PRIMARY KEY(produit_id, magasin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_magasin ADD CONSTRAINT FK_9254D45EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_magasin ADD CONSTRAINT FK_9254D45E20096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_magasin DROP FOREIGN KEY FK_9254D45E20096AE3');
        $this->addSql('ALTER TABLE produit_magasin DROP FOREIGN KEY FK_9254D45EF347EFB');
        $this->addSql('DROP TABLE magasin');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_magasin');
    }
}
