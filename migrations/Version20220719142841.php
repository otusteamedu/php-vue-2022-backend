<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220719142841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "lead_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "lead" (id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, full_name_surname VARCHAR(255) DEFAULT NULL, full_name_name VARCHAR(255) DEFAULT NULL, full_name_patronymic VARCHAR(255) DEFAULT NULL, birthday_value TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, phone_number VARCHAR(10) DEFAULT NULL, passport_serial VARCHAR(4) DEFAULT NULL, passport_number VARCHAR(6) DEFAULT NULL, passport_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "lead".created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "lead".birthday_value IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "lead".passport_date IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE "lead_id_seq" CASCADE');
        $this->addSql('DROP TABLE "lead"');
    }
}
