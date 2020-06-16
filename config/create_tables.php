<?php

include("./db.php");

// Table creation queries
$TInfected = "
    CREATE TABLE IF NOT EXISTS `infected` (
        `CIN` varchar(8) NOT NULL,
        `username` varchar(10) NOT NULL,
        `password` varchar(20) NOT NULL,
        `firstname` varchar(20) NOT NULL,
        `lastname` varchar(20) NOT NULL,
        `isImported` tinyint(1) NOT NULL DEFAULT '0',
        `imported_from` varchar(10) DEFAULT NULL,
        `isValid` tinyint(1) NOT NULL DEFAULT '1',
        `zone_id` int(11) DEFAULT NULL,
        PRIMARY KEY (`CIN`),
        UNIQUE KEY `username` (`username`),
        KEY `zone_id` (`zone_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$TEmplacement = "
    CREATE TABLE IF NOT EXISTS `emplacement` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `latitude` varchar(20) NOT NULL,
        `longitude` varchar(20) NOT NULL,
        `infected_cin` varchar(8) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `infected_cin` (`infected_cin`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$TZone = "
    CREATE TABLE IF NOT EXISTS `zone` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `nom` varchar(50) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$TAdministrator = "
    CREATE TABLE IF NOT EXISTS `administrator` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(20) NOT NULL,
        `password` varchar(20) NOT NULL,
        `isSuper` tinyint(1) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`),
        UNIQUE KEY `username` (`username`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";

// Table relations queries
$emplacement_infected = "
    ALTER TABLE `emplacement`
    ADD CONSTRAINT `emplacement_ibfk_1` FOREIGN KEY (`infected_cin`) REFERENCES `infected` (`CIN`);
";

$infected_zone = "
    ALTER TABLE `infected`
    ADD CONSTRAINT `infected_ibfk_1` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`);
";