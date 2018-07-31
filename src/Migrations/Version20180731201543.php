<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180731201543 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lottery_deposit (id INT AUTO_INCREMENT NOT NULL, player_uuid INT NOT NULL, processed_at DATETIME NOT NULL, amount NUMERIC(18, 2) NOT NULL, currency VARCHAR(3) NOT NULL, INDEX IDX_5CDEC1DA73650095 (player_uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lottery_profile (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lottery_deposit ADD CONSTRAINT FK_5CDEC1DA73650095 FOREIGN KEY (player_uuid) REFERENCES lottery_profile (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lottery_deposit DROP FOREIGN KEY FK_5CDEC1DA73650095');
        $this->addSql('DROP TABLE lottery_deposit');
        $this->addSql('DROP TABLE lottery_profile');
    }
}
