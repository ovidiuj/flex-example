<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180924151031 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, city_name VARCHAR(255) NOT NULL, timezone VARCHAR(255) NOT NULL, country_code VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2D5B0234BD6D436E (city_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city_data (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, max_temp DOUBLE PRECISION NOT NULL, datetime VARCHAR(255) NOT NULL, temp DOUBLE PRECISION NOT NULL, min_temp DOUBLE PRECISION NOT NULL, INDEX IDX_4EBDCE0B8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city_data ADD CONSTRAINT FK_4EBDCE0B8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE city_data DROP FOREIGN KEY FK_4EBDCE0B8BAC62AF');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE city_data');
    }
}
