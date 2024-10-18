<?php
/*
  Fichier : src/config/config.prod.php
*/
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

/**
 * le DSN de la base
 */
define('APP_DB_DSN', 'mysql:host=mysql-srochedix.alwaysdata.net;dbname=srochedix_reignswebapp;charset=UTF8');

/**
 * le nom de l'utilisateur MYSQL
 */
define('APP_DB_USER', 'srochedix');

/**
 * le mot de passe de l'utilisateur MYSQL
 */
define('APP_DB_PASSWORD', 'xQ2$gN3~lH3~qN2)');

/**
 * le préfixe des tables dans la base (utile pour les bases partagées)
 */
define('APP_TABLE_PREFIX', '');
