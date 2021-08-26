<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823191735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14222C25C5');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, date_naiss VARCHAR(100) NOT NULL, nom_etablissement VARCHAR(100) NOT NULL, nom_examen VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE dossier_eleve');
        $this->addSql('DROP TABLE note');
        $this->addSql('ALTER TABLE convocation DROP FOREIGN KEY FK_C03B3F5FA76ED395');
        $this->addSql('DROP INDEX IDX_C03B3F5FA76ED395 ON convocation');
        $this->addSql('ALTER TABLE convocation DROP user_id, CHANGE nom_convocation nom_convocation VARCHAR(50) NOT NULL, CHANGE date_convocation date_convocation VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1A76ED395');
        $this->addSql('DROP INDEX IDX_81A72FA1A76ED395 ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP user_id, CHANGE matricule matricule VARCHAR(25) NOT NULL, CHANGE adresse adresse VARCHAR(50) NOT NULL, CHANGE ville ville VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE epreuve CHANGE nom_epreuve nom_epreuve VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CA76ED395');
        $this->addSql('DROP INDEX IDX_20FD592CA76ED395 ON etablissement');
        $this->addSql('ALTER TABLE etablissement ADD nom_etablissement VARCHAR(50) NOT NULL, DROP user_id, DROP nom, CHANGE adresse adresse VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE examen ADD user_id INT DEFAULT NULL, ADD date VARCHAR(20) NOT NULL, DROP date_examen, CHANGE nom_examen nom_examen VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE examen ADD CONSTRAINT FK_514C8FECA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_514C8FECA76ED395 ON examen (user_id)');
        $this->addSql('ALTER TABLE user ADD inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6495DAC5993 ON user (inscription_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495DAC5993');
        $this->addSql('CREATE TABLE dossier_eleve (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, etablissement_id INT DEFAULT NULL, examen_id INT DEFAULT NULL, nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_naiss VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom_examen VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom_etablissement VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, numero VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_25211FB0FF631228 (etablissement_id), INDEX IDX_25211FB05C8659A (examen_id), INDEX IDX_25211FB0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, epreuve_id INT DEFAULT NULL, dossier_eleve_id INT DEFAULT NULL, note_obtenue DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_CFBDFA14AB990336 (epreuve_id), INDEX IDX_CFBDFA14222C25C5 (dossier_eleve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE dossier_eleve ADD CONSTRAINT FK_25211FB05C8659A FOREIGN KEY (examen_id) REFERENCES examen (id)');
        $this->addSql('ALTER TABLE dossier_eleve ADD CONSTRAINT FK_25211FB0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE dossier_eleve ADD CONSTRAINT FK_25211FB0FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14222C25C5 FOREIGN KEY (dossier_eleve_id) REFERENCES dossier_eleve (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14AB990336 FOREIGN KEY (epreuve_id) REFERENCES epreuve (id)');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('ALTER TABLE convocation ADD user_id INT DEFAULT NULL, CHANGE nom_convocation nom_convocation VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date_convocation date_convocation DATE NOT NULL');
        $this->addSql('ALTER TABLE convocation ADD CONSTRAINT FK_C03B3F5FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C03B3F5FA76ED395 ON convocation (user_id)');
        $this->addSql('ALTER TABLE enseignant ADD user_id INT DEFAULT NULL, CHANGE matricule matricule VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA1A76ED395 ON enseignant (user_id)');
        $this->addSql('ALTER TABLE epreuve CHANGE nom_epreuve nom_epreuve VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE etablissement ADD user_id INT DEFAULT NULL, ADD nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP nom_etablissement, CHANGE adresse adresse VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_20FD592CA76ED395 ON etablissement (user_id)');
        $this->addSql('ALTER TABLE examen DROP FOREIGN KEY FK_514C8FECA76ED395');
        $this->addSql('DROP INDEX IDX_514C8FECA76ED395 ON examen');
        $this->addSql('ALTER TABLE examen ADD date_examen VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP user_id, DROP date, CHANGE nom_examen nom_examen VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_8D93D6495DAC5993 ON user');
        $this->addSql('ALTER TABLE user DROP inscription_id');
    }
}
