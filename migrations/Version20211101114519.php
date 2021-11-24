<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211101114519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE editor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editor_game (editor_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_C9EAA1456995AC4C (editor_id), INDEX IDX_C9EAA145E48FD905 (game_id), PRIMARY KEY(editor_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, release_date DATETIME NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre_game (genre_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_98C6E87C4296D31F (genre_id), INDEX IDX_98C6E87CE48FD905 (game_id), PRIMARY KEY(genre_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform_game (platform_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_A72356A0FFE6496F (platform_id), INDEX IDX_A72356A0E48FD905 (game_id), PRIMARY KEY(platform_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_game (type_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_F424F484C54C8C93 (type_id), INDEX IDX_F424F484E48FD905 (game_id), PRIMARY KEY(type_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE editor_game ADD CONSTRAINT FK_C9EAA1456995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editor_game ADD CONSTRAINT FK_C9EAA145E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_game ADD CONSTRAINT FK_98C6E87C4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_game ADD CONSTRAINT FK_98C6E87CE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE platform_game ADD CONSTRAINT FK_A72356A0FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE platform_game ADD CONSTRAINT FK_A72356A0E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_game ADD CONSTRAINT FK_F424F484C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_game ADD CONSTRAINT FK_F424F484E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE editor_game DROP FOREIGN KEY FK_C9EAA1456995AC4C');
        $this->addSql('ALTER TABLE editor_game DROP FOREIGN KEY FK_C9EAA145E48FD905');
        $this->addSql('ALTER TABLE genre_game DROP FOREIGN KEY FK_98C6E87CE48FD905');
        $this->addSql('ALTER TABLE platform_game DROP FOREIGN KEY FK_A72356A0E48FD905');
        $this->addSql('ALTER TABLE type_game DROP FOREIGN KEY FK_F424F484E48FD905');
        $this->addSql('ALTER TABLE genre_game DROP FOREIGN KEY FK_98C6E87C4296D31F');
        $this->addSql('ALTER TABLE platform_game DROP FOREIGN KEY FK_A72356A0FFE6496F');
        $this->addSql('ALTER TABLE type_game DROP FOREIGN KEY FK_F424F484C54C8C93');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE editor_game');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE genre_game');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE platform_game');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_game');
    }
}
