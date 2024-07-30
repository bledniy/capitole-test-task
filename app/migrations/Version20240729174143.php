<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240729174143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates discount and product tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE discount_id_seq INCREMENT BY 1 MINVALUE 1 START 1');

        $this->addSql('
            CREATE TABLE discount (
                id INT NOT NULL PRIMARY KEY,
                category VARCHAR(255) DEFAULT NULL,
                sku VARCHAR(255) DEFAULT NULL,
                percentage DOUBLE PRECISION NOT NULL
            )
        ');
        $this->addSql('
            CREATE TABLE product (
                sku VARCHAR(255) NOT NULL PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                category VARCHAR(255) NOT NULL,
                price INT NOT NULL
            )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE discount_id_seq CASCADE');
        $this->addSql('DROP TABLE discount');
        $this->addSql('DROP TABLE product');
    }
}

