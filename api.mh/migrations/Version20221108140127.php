<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108140127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE match_resume DROP FOREIGN KEY FK_C1AE29A199E6F5DF');
        $this->addSql('DROP INDEX IDX_C1AE29A199E6F5DF ON match_resume');
        $this->addSql('ALTER TABLE match_resume DROP player_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE match_resume ADD player_id INT NOT NULL');
        $this->addSql('ALTER TABLE match_resume ADD CONSTRAINT FK_C1AE29A199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('CREATE INDEX IDX_C1AE29A199E6F5DF ON match_resume (player_id)');
    }
}