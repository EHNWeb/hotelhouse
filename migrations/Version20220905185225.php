<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905185225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_chambre (id INT AUTO_INCREMENT NOT NULL, id_chambre_id INT NOT NULL, id_membre_id INT NOT NULL, date_arrivee DATETIME NOT NULL, date_depart DATETIME NOT NULL, id_option_lit INT DEFAULT NULL, id_option_animal INT DEFAULT NULL, id_option_parking INT DEFAULT NULL, id_option_early_checkin INT DEFAULT NULL, id_option_early_checkout INT DEFAULT NULL, id_option_tds INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, date_enregistrement DATETIME NOT NULL, INDEX IDX_33B2965F3E9DFF83 (id_chambre_id), INDEX IDX_33B2965FEAAC4B6D (id_membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_chambre ADD CONSTRAINT FK_33B2965F3E9DFF83 FOREIGN KEY (id_chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE commande_chambre ADD CONSTRAINT FK_33B2965FEAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_chambre DROP FOREIGN KEY FK_33B2965F3E9DFF83');
        $this->addSql('ALTER TABLE commande_chambre DROP FOREIGN KEY FK_33B2965FEAAC4B6D');
        $this->addSql('DROP TABLE commande_chambre');
    }
}
