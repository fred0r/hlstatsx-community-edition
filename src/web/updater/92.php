<?php
    if ( !defined('IN_UPDATER') )
    {
        die('Do not access this file directly.');
    }

    $dbversion = 92;
    $version = "1.11.6";


    // Perform database schema update notification
    print "Updating database and version schema numbers.<br />";
    $db->query("UPDATE hlstats_Options SET `value` = '$version' WHERE `keyname` = 'version'");
    $db->query("UPDATE hlstats_Options SET `value` = '$dbversion' WHERE `keyname` = 'dbversion'");

    // Ajout d'index pour optimiser les requêtes fréquentes
    $db->query("
        ALTER TABLE hlstats_Events_Frags 
        ADD INDEX idx_killer_victim (killerId, victimId),
        ADD INDEX idx_weapon (weapon),
        ADD INDEX idx_server (serverId),
        ADD INDEX idx_event_time (eventTime)
    ", false);

    $db->query("
        ALTER TABLE hlstats_Events_PlayerActions 
        ADD INDEX idx_player_game (playerId, game),
        ADD INDEX idx_action (actionId)
    ", false);

    $db->query("
        ALTER TABLE hlstats_Events_PlayerPlayerActions 
        ADD INDEX idx_player_victim (playerId, victimId),
        ADD INDEX idx_action_game (actionId, game)
    ", false);

    $db->query("
        ALTER TABLE hlstats_Events_Teamkills 
        ADD INDEX idx_killer_victim (killerId, victimId),
        ADD INDEX idx_server (serverId)
    ", false);

    $db->query("
        ALTER TABLE hlstats_Events_ChangeRole 
        ADD INDEX idx_player (playerId)
    ", false);

    $db->query("
        ALTER TABLE hlstats_Events_ChangeTeam 
        ADD INDEX idx_player_game (playerId, game)
    ", false);

    $db->query("
        ALTER TABLE hlstats_Events_ChangeName 
        ADD INDEX idx_player (playerId)
    ", false);

    $db->query("
        ALTER TABLE hlstats_Events_Suicides 
        ADD INDEX idx_player_server (playerId, serverId)
    ", false);

    $db->query("
        ALTER TABLE hlstats_Events_Connects 
        ADD INDEX idx_player_server (playerId, serverId)
    ", false);

    $db->query("
        ALTER TABLE hlstats_Events_Disconnects 
        ADD INDEX idx_player_server (playerId, serverId)
    ", false);

    $db->query("
        ALTER TABLE hlstats_Events_Entries 
        ADD INDEX idx_player_server (playerId, serverId)
    ", false);
?>
