<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211127162959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_authors (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_categories (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, INDEX IDX_DC356481727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blogs (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', category_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', author_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_F41BCA7012469DE2 (category_id), INDEX IDX_F41BCA70F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_categories ADD CONSTRAINT FK_DC356481727ACA70 FOREIGN KEY (parent_id) REFERENCES blog_categories (id)');
        $this->addSql('ALTER TABLE blogs ADD CONSTRAINT FK_F41BCA7012469DE2 FOREIGN KEY (category_id) REFERENCES blog_categories (id)');
        $this->addSql('ALTER TABLE blogs ADD CONSTRAINT FK_F41BCA70F675F31B FOREIGN KEY (author_id) REFERENCES blog_authors (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blogs DROP FOREIGN KEY FK_F41BCA70F675F31B');
        $this->addSql('ALTER TABLE blog_categories DROP FOREIGN KEY FK_DC356481727ACA70');
        $this->addSql('ALTER TABLE blogs DROP FOREIGN KEY FK_F41BCA7012469DE2');
        $this->addSql('DROP TABLE blog_authors');
        $this->addSql('DROP TABLE blog_categories');
        $this->addSql('DROP TABLE blogs');
    }
}
