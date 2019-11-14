<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191113091227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_learning_module (user_id INT NOT NULL, learning_module_id INT NOT NULL, INDEX IDX_D80A015EA76ED395 (user_id), INDEX IDX_D80A015E55E9F8F6 (learning_module_id), PRIMARY KEY(user_id, learning_module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE completed_modules');
        $this->addSql('ALTER TABLE chapter_translation CHANGE description description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE completed_modules (user_id INT NOT NULL, learning_module_id INT NOT NULL, INDEX IDX_D80A015EA76ED395 (user_id), INDEX IDX_D80A015E55E9F8F6 (learning_module_id), PRIMARY KEY(user_id, learning_module_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE completed_modules ADD CONSTRAINT FK_D80A015E55E9F8F6 FOREIGN KEY (learning_module_id) REFERENCES learning_module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE completed_modules ADD CONSTRAINT FK_D80A015EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user_learning_module');
        $this->addSql('ALTER TABLE chapter_translation CHANGE description description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}