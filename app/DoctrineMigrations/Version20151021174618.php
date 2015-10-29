<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151021174618 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql(
            "CREATE TABLE `game` (
               `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
               `time` datetime NOT NULL,
               `stadium_id` int(10) unsigned DEFAULT NULL,
               `organizer_team_id` int(10) unsigned DEFAULT NULL,
               `guest_team_id` int(10) unsigned DEFAULT NULL,
               `score` varchar(45) NOT NULL,
               `winner_team_id` int(10) unsigned DEFAULT NULL,
               `looser_team_id` int(10) unsigned DEFAULT NULL,
               `status_id` int(11) DEFAULT NULL,
               `tournament_id` int(11) DEFAULT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );

        $this->addSql(
            "CREATE TABLE `game_status` (
               `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
               `desc` varchar(255) DEFAULT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );

        $this->addSql(
            "CREATE TABLE `player` (
               `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
               `name` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
               `birthday` date DEFAULT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );

        $this->addSql(
            "CREATE TABLE `player_to_team` (
               `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
               `player_id` int(10) unsigned NOT NULL,
               `team_id` int(10) unsigned NOT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );

        $this->addSql(
            "CREATE TABLE `stadium` (
               `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
               `location` varchar(255) DEFAULT NULL,
               `title` varchar(255) DEFAULT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );

        $this->addSql(
            "CREATE TABLE `stadium_to_team` (
               `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
               `stadium_id` int(11) unsigned NOT NULL,
               `team_id` int(11) unsigned NOT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );

        $this->addSql(
            "CREATE TABLE `team` (
               `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
               `name` varchar(100) DEFAULT NULL,
               `address_id` int(11) DEFAULT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );

        $this->addSql(
            "CREATE TABLE `team_to_tournament` (
               `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
               `team_id` int(10) unsigned NOT NULL,
               `tournament_id` int(10) unsigned NOT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );

        $this->addSql(
            "CREATE TABLE `tournament` (
               `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
               `title` varchar(255) DEFAULT NULL,
               `start_date` date NOT NULL,
               `finish_date` date NOT NULL,
               `count_player` int(10) unsigned NOT NULL,
               `game_time` int(10) unsigned NOT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );

        $this->addSql("CREATE TABLE `location_address` (
               `id` int(11) NOT NULL AUTO_INCREMENT,
               `location_region_id` int(11) DEFAULT NULL,
               `location_city_id` int(11) DEFAULT NULL,
               `location_country_id` int(11) DEFAULT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8");

        $this->addSql("CREATE TABLE `location_city` (
               `id` int(11) NOT NULL AUTO_INCREMENT,
               `location_country_id` int(11) DEFAULT NULL,
               `location_region_id` int(11) DEFAULT NULL,
               `name` varchar(255) DEFAULT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8");

        $this->addSql("CREATE TABLE `location_country` (
               `id` int(11) NOT NULL AUTO_INCREMENT,
               `name` varchar(255) DEFAULT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");

        $this->addSql("CREATE TABLE `location_region` (
               `id` int(11) NOT NULL AUTO_INCREMENT,
               `location_country_id` int(11) DEFAULT NULL,
               `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
               PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_status');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_to_team');
        $this->addSql('DROP TABLE stadium');
        $this->addSql('DROP TABLE stadium_to_team');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_to_tournament');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE location_region');
        $this->addSql('DROP TABLE location_country');
        $this->addSql('DROP TABLE location_city');
        $this->addSql('DROP TABLE location_address');
    }
}
