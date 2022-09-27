<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927085643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE match_resume DROP FOREIGN KEY FK_C1AE29A1C036E511');
        $this->addSql('DROP INDEX IDX_C1AE29A1C036E511 ON match_resume');
        $this->addSql('ALTER TABLE match_resume CHANGE player_id_id player_id INT NOT NULL');
        $this->addSql('ALTER TABLE match_resume ADD CONSTRAINT FK_C1AE29A199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('CREATE INDEX IDX_C1AE29A199E6F5DF ON match_resume (player_id)');
        $this->addSql('ALTER TABLE match_timeline DROP FOREIGN KEY FK_9B841CF0C12EE1F6');
        $this->addSql('DROP INDEX UNIQ_9B841CF0C12EE1F6 ON match_timeline');
        $this->addSql('ALTER TABLE match_timeline CHANGE match_id_id matchs_id INT NOT NULL');
        $this->addSql('ALTER TABLE match_timeline ADD CONSTRAINT FK_9B841CF088EB7468 FOREIGN KEY (matchs_id) REFERENCES match_resume (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B841CF088EB7468 ON match_timeline (matchs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE match_resume DROP FOREIGN KEY FK_C1AE29A199E6F5DF');
        $this->addSql('DROP INDEX IDX_C1AE29A199E6F5DF ON match_resume');
        $this->addSql('ALTER TABLE match_resume CHANGE player_id player_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE match_resume ADD CONSTRAINT FK_C1AE29A1C036E511 FOREIGN KEY (player_id_id) REFERENCES player (id)');
        $this->addSql('CREATE INDEX IDX_C1AE29A1C036E511 ON match_resume (player_id_id)');
        $this->addSql('ALTER TABLE match_timeline DROP FOREIGN KEY FK_9B841CF088EB7468');
        $this->addSql('DROP INDEX UNIQ_9B841CF088EB7468 ON match_timeline');
        $this->addSql('ALTER TABLE match_timeline CHANGE matchs_id match_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE match_timeline ADD CONSTRAINT FK_9B841CF0C12EE1F6 FOREIGN KEY (match_id_id) REFERENCES match_resume (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B841CF0C12EE1F6 ON match_timeline (match_id_id)');
    }
}
