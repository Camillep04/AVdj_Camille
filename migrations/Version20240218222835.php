<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218222835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mot_cles (id INT AUTO_INCREMENT NOT NULL, mot_cles VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mot_cles_marque_page (mot_cles_id INT NOT NULL, marque_page_id INT NOT NULL, INDEX IDX_D48592B3855234A9 (mot_cles_id), INDEX IDX_D48592B3D59CC0F1 (marque_page_id), PRIMARY KEY(mot_cles_id, marque_page_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mot_cles_marque_page ADD CONSTRAINT FK_D48592B3855234A9 FOREIGN KEY (mot_cles_id) REFERENCES mot_cles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mot_cles_marque_page ADD CONSTRAINT FK_D48592B3D59CC0F1 FOREIGN KEY (marque_page_id) REFERENCES marque_page (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mot_cles_marque_page DROP FOREIGN KEY FK_D48592B3855234A9');
        $this->addSql('ALTER TABLE mot_cles_marque_page DROP FOREIGN KEY FK_D48592B3D59CC0F1');
        $this->addSql('DROP TABLE mot_cles');
        $this->addSql('DROP TABLE mot_cles_marque_page');
    }
}
