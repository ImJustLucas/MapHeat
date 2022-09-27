<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927121349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE match_resume (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, INDEX IDX_C1AE29A199E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE match_timeline (id INT AUTO_INCREMENT NOT NULL, matchs_id INT NOT NULL, UNIQUE INDEX UNIQ_9B841CF088EB7468 (matchs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, puuid VARCHAR(79) NOT NULL, name VARCHAR(255) NOT NULL, profil_icon_id INT NOT NULL, summoner_lv DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE match_resume ADD CONSTRAINT FK_C1AE29A199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE match_timeline ADD CONSTRAINT FK_9B841CF088EB7468 FOREIGN KEY (matchs_id) REFERENCES match_resume (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE match_resume DROP FOREIGN KEY FK_C1AE29A199E6F5DF');
        $this->addSql('ALTER TABLE match_timeline DROP FOREIGN KEY FK_9B841CF088EB7468');
        $this->addSql('DROP TABLE match_resume');
        $this->addSql('DROP TABLE match_timeline');
        $this->addSql('DROP TABLE player');
    }
}
