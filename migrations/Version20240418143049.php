<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240418143049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates application database schema';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE currencies (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(128) NOT NULL, currency_code VARCHAR(60) NOT NULL, exchange_rate INT NOT NULL, UNIQUE INDEX UNIQ_37C44693FDA273EC (currency_code), INDEX curr_code_idx (currency_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE currencies');
    }
}
