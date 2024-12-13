<?php

// BEGIN iThemes Security - Ne modifiez pas ou ne supprimez pas cette ligne
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Désactivez l’éditeur de code - Solid Security > Réglages > Ajustements WordPress > Éditeur de code
// END iThemes Security - Ne modifiez pas ou ne supprimez pas cette ligne

/** Définition des nouveaux PATHS de WordPress. */
define( 'WP_CONTENT_DIR', dirname( __FILE__ ));
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] );

define( 'WP_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/lib' );
define( 'WP_PLUGIN_URL', 'http://' . $_SERVER['HTTP_HOST'] .'/lib' );

/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'rubisenergie');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xiPS+G,Q$3,|lwOPArp`=  $vg(M<*/|S8x.Pm!yf9-dSfn3IVGvm,F}yH<re&7u');
define('SECURE_AUTH_KEY',  '-V(<*y(:ld!pTq[8+R9rWH#GL?eMDk[;.Xv6Q-@7`H,uYWuk~<h91`AX{-jyhZXH');
define('LOGGED_IN_KEY',    '|X wp7x[)~.N+Y)>$vaN}bjl++xSfC/F]-0+JK-SI4Ok+&;+m|olm<U]%7|3vOz~');
define('NONCE_KEY',        'd3<&z:*OjExP=2}j|.p|sW<FOuis{u6z-^:Zv+!SKo+R <ID|<y}T*|T1])d.vg[');
define('AUTH_SALT',        ',Gq1Ey0-w~8EaH5J^OrFPWuR(CQK}r-hee-ICiBfdVO:~mvcCdjR?MIdEE9{};)j');
define('SECURE_AUTH_SALT', '**m3 X6$rlH;e-09L3vT mXC-dVZsWyJ]?b|S@VO-N)wlN?Q7n k.FrF>/~MX8|{');
define('LOGGED_IN_SALT',   '-Ie!-5Lh?HbycWP|y]p@0;A;5d-+`TnKH37 6W[y;BCN&|k^pvTf[tgw{py*c2)4');
define('NONCE_SALT',       'kEs-%| 3$9B]t@.WAmb}4EWky8:whcH*cH3;4!UaS&1o{lQ%63(X=bL1*UUG4iGp');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wprubis_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('FS_METHOD', 'direct');
define('WPLANG', 'fr_FR');
define('WP_DEBUG', false);
define('WP_POST_REVISIONS', false);
define('AUTOSAVE_INTERVAL', 9999 );
define('WP_AUTO_UPDATE_CORE', false);
define('WP_MEMORY_LIMIT', '96M');
define('FORCE_SSL_ADMIN', true);

$wp_theme_directories = array(__DIR__ . '/assets');
define('WP_DEFAULT_THEME', 'rubis');

define( 'SMTP_HOST', 'rubisenergie-com.mail.protection.outlook.com' );
define( 'SMTP_AUTH', false );
define( 'SMTP_PORT', '25' );
/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
