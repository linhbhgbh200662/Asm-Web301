<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220622031625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_detail (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_detail (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, unit_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, orders_id INT DEFAULT NULL, quantity INT NOT NULL, date DATE NOT NULL, INDEX IDX_E52FFDEECFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, orderdetail_id INT DEFAULT NULL, cartdetail_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_D34A04AD17E8A46A (orderdetail_id), INDEX IDX_D34A04AD688F09B0 (cartdetail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEECFFE9AD6 FOREIGN KEY (orders_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD17E8A46A FOREIGN KEY (orderdetail_id) REFERENCES order_detail (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD688F09B0 FOREIGN KEY (cartdetail_id) REFERENCES cart_detail (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD688F09B0');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEECFFE9AD6');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD17E8A46A');
        $this->addSql('DROP TABLE cart_detail');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE order_detail');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE product');
    }
}
