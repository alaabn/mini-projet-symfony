<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230506213010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2038A207D2E86869 ON plat (nom_plat)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA864A7C2A49D52B ON regime (nom_regime)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_2038A207D2E86869 ON plat');
        $this->addSql('DROP INDEX UNIQ_AA864A7C2A49D52B ON regime');
    }
}
