<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240418161422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alignment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign_user (campaign_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8C74EDABF639F774 (campaign_id), INDEX IDX_8C74EDABA76ED395 (user_id), PRIMARY KEY(campaign_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign_character (campaign_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_53F2AC4FF639F774 (campaign_id), INDEX IDX_53F2AC4F1136BE75 (character_id), PRIMARY KEY(campaign_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero (id INT AUTO_INCREMENT NOT NULL, alignment_id INT NOT NULL, job_id INT NOT NULL, race_id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, character_avatar_url VARCHAR(255) DEFAULT NULL, level INT NOT NULL, lifepoints INT NOT NULL, age INT NOT NULL, background LONGTEXT DEFAULT NULL, stat_strength INT NOT NULL, stat_dexterity INT NOT NULL, stat_endurance INT NOT NULL, stat_intelligence INT NOT NULL, stat_wisdom INT NOT NULL, stat_charisma INT NOT NULL, INDEX IDX_51CE6E86AB7AC2A0 (alignment_id), INDEX IDX_51CE6E86BE04EA9 (job_id), INDEX IDX_51CE6E866E59D40D (race_id), INDEX IDX_51CE6E86A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, job_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, strength_modifier INT NOT NULL, dexterity_modifier INT NOT NULL, endurance_modifier INT NOT NULL, intelligence_modifier INT NOT NULL, wisdom_modifier INT NOT NULL, charisma_modifier INT NOT NULL, race_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, user_avatar_url VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE campaign_user ADD CONSTRAINT FK_8C74EDABF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign_user ADD CONSTRAINT FK_8C74EDABA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign_character ADD CONSTRAINT FK_53F2AC4FF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign_character ADD CONSTRAINT FK_53F2AC4F1136BE75 FOREIGN KEY (character_id) REFERENCES hero (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86AB7AC2A0 FOREIGN KEY (alignment_id) REFERENCES alignment (id)');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E866E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campaign_user DROP FOREIGN KEY FK_8C74EDABF639F774');
        $this->addSql('ALTER TABLE campaign_user DROP FOREIGN KEY FK_8C74EDABA76ED395');
        $this->addSql('ALTER TABLE campaign_character DROP FOREIGN KEY FK_53F2AC4FF639F774');
        $this->addSql('ALTER TABLE campaign_character DROP FOREIGN KEY FK_53F2AC4F1136BE75');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86AB7AC2A0');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86BE04EA9');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E866E59D40D');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86A76ED395');
        $this->addSql('DROP TABLE alignment');
        $this->addSql('DROP TABLE campaign');
        $this->addSql('DROP TABLE campaign_user');
        $this->addSql('DROP TABLE campaign_character');
        $this->addSql('DROP TABLE hero');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
