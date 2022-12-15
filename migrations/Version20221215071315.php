<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221215071315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz ADD pro_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92C3B7E4BA FOREIGN KEY (pro_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A412FA92C3B7E4BA ON quiz (pro_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92C3B7E4BA');
        $this->addSql('DROP INDEX IDX_A412FA92C3B7E4BA ON quiz');
        $this->addSql('ALTER TABLE quiz DROP pro_id');
    }
}
