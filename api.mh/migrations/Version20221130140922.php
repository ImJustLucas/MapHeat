<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130140922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE match_resume (id INT AUTO_INCREMENT NOT NULL, game_mode VARCHAR(255) NOT NULL, game_lenght DOUBLE PRECISION NOT NULL, champ_level INT NOT NULL, champion_id INT NOT NULL, deaths INT NOT NULL, kills INT NOT NULL, assists INT NOT NULL, champion_name VARCHAR(255) NOT NULL, item LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', sum_1 INT NOT NULL, sum_2 INT NOT NULL, perk_1 INT NOT NULL, perk_2 INT NOT NULL, wards_placed INT NOT NULL, win TINYINT(1) NOT NULL, puuid VARCHAR(255) NOT NULL, matchid VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE match_timeline (id INT AUTO_INCREMENT NOT NULL, match_id VARCHAR(255) NOT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, puuid VARCHAR(79) NOT NULL, name VARCHAR(255) NOT NULL, profil_icon_id INT NOT NULL, summoner_lv INT NOT NULL, matchs_id LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE match_resume');
        $this->addSql('DROP TABLE match_timeline');
        $this->addSql('DROP TABLE player');
    }
}
