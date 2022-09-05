<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905190230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_spa (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT NOT NULL, id_spa_id INT NOT NULL, date_arrivee DATETIME NOT NULL, date_depart DATETIME NOT NULL, nb_personne INT NOT NULL, option_allergie TINYINT(1) DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, date_enregistrement DATETIME NOT NULL, INDEX IDX_BB2C3073EAAC4B6D (id_membre_id), INDEX IDX_BB2C3073F90B07AA (id_spa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_spa ADD CONSTRAINT FK_BB2C3073EAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE commande_spa ADD CONSTRAINT FK_BB2C3073F90B07AA FOREIGN KEY (id_spa_id) REFERENCES spa (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_spa DROP FOREIGN KEY FK_BB2C3073EAAC4B6D');
        $this->addSql('ALTER TABLE commande_spa DROP FOREIGN KEY FK_BB2C3073F90B07AA');
        $this->addSql('DROP TABLE commande_spa');
    }
}
