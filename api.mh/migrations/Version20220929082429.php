<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929082429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE match_resume ADD game_mode VARCHAR(255) NOT NULL, ADD game_end_timestamp DOUBLE PRECISION NOT NULL, ADD game_length DOUBLE PRECISION NOT NULL, ADD kda DOUBLE PRECISION NOT NULL, ADD champ_level INT NOT NULL, ADD champion_id INT NOT NULL, ADD deaths INT NOT NULL, ADD kills INT NOT NULL, ADD assists INT NOT NULL, ADD champion_name VARCHAR(255) NOT NULL, ADD item LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD lane VARCHAR(255) NOT NULL, ADD wards_placed INT NOT NULL, ADD win TINYINT(1) NOT NULL, ADD puuid VARCHAR(255) NOT NULL, ADD matchid VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE player ADD matchs_id LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE match_resume DROP game_mode, DROP game_end_timestamp, DROP game_length, DROP kda, DROP champ_level, DROP champion_id, DROP deaths, DROP kills, DROP assists, DROP champion_name, DROP item, DROP lane, DROP wards_placed, DROP win, DROP puuid, DROP matchid');
        $this->addSql('ALTER TABLE player DROP matchs_id');
    }
}
