<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905185652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_restaurant (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT NOT NULL, date_arrivee DATETIME NOT NULL, date_depart DATETIME NOT NULL, nb_personne INT NOT NULL, option_room_service TINYINT(1) DEFAULT NULL, option_allergie TINYINT(1) DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, date_enregistrement DATETIME NOT NULL, INDEX IDX_73573ED9EAAC4B6D (id_membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_restaurant ADD CONSTRAINT FK_73573ED9EAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_restaurant DROP FOREIGN KEY FK_73573ED9EAAC4B6D');
        $this->addSql('DROP TABLE commande_restaurant');
    }
}
