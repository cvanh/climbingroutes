<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240320100930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, area_id_id INT NOT NULL, INDEX IDX_6A2CA10CF28ED68D (area_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CF28ED68D FOREIGN KEY (area_id_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE area CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE area ADD CONSTRAINT FK_D7943D68F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CF28ED68D');
        $this->addSql('DROP TABLE media');
        $this->addSql('ALTER TABLE area DROP FOREIGN KEY FK_D7943D68F675F31B');
        $this->addSql('ALTER TABLE area CHANGE parent_id parent_id INT NOT NULL');
    }
}
