<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220312135603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club (ref VARCHAR(25) NOT NULL, creation_date DATE NOT NULL, PRIMARY KEY(ref)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_club (club_ref VARCHAR(25) NOT NULL, student_nsc VARCHAR(25) NOT NULL, INDEX IDX_87CD43AAB70D1EBA (club_ref), INDEX IDX_87CD43AAFBDC2049 (student_nsc), PRIMARY KEY(club_ref, student_nsc)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student_club ADD CONSTRAINT FK_87CD43AAB70D1EBA FOREIGN KEY (club_ref) REFERENCES club (ref) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_club ADD CONSTRAINT FK_87CD43AAFBDC2049 FOREIGN KEY (student_nsc) REFERENCES student (nsc) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student_club DROP FOREIGN KEY FK_87CD43AAB70D1EBA');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE student_club');
        $this->addSql('ALTER TABLE classroom CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE student CHANGE nsc nsc VARCHAR(25) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE teacher CHANGE name name VARCHAR(25) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
