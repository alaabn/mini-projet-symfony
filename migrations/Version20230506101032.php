<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230506101032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A20735E7D534');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A20735E7D534 FOREIGN KEY (regime_id) REFERENCES regime (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A20735E7D534');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A20735E7D534 FOREIGN KEY (regime_id) REFERENCES regime (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
