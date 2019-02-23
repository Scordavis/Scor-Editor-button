<?php
define('WP_HOME', 'http://abcde.com');
define('WP_SITEURL', 'http://abcde.com');

/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\OSPanel\domains\abcde.com\wp-content\plugins\wp-super-cache/' );
define('DB_NAME', 'wp-theme');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '{^bYTI`L_sr*4Wl!cC+vd:bN^o+m;vERSK<U_C-;4t6gS$@]zL$K|QL|[gJ!tzJo');
define('SECURE_AUTH_KEY',  'bITqZ$3)sJ+H>bV,of-rqV}&n$z:Ac+AHaUDd$h&c-a5|kExqREYM&J~4<m.MrP,');
define('LOGGED_IN_KEY',    '/GHk(0MIZ`C8H0Mzqf.gTV20QwdAPlv{pf8[;FPyXAiKywp Wp+b/3sf+8e*YJ_,');
define('NONCE_KEY',        'k^VBxk<D,[TyH^wY5W7w9feU@Q%mmz`.>G-ccUeN-X[jh^*_BdipKQ!:d DeC@Hr');
define('AUTH_SALT',        'OJ:7+lbO>gdbvo<zHM-_Z8N=ob$-:SA]|K)c`4U4M6#Aiduh,:e3x&t zs+T$GU`');
define('SECURE_AUTH_SALT', 'f.R0Zwc-OoS:c%b84x)|g^`S@v-, T$t|)`&.v~&~!1w8Y|^=bINs<v)z*1nuE[J');
define('LOGGED_IN_SALT',   'k-y9Ch`|l:+BmHNh[LXzEV~]DZsZ]@Iuk]xsFdWP;:jeLv<Qb!ws27eK^ATZ-:&@');
define('NONCE_SALT',       'u?+>Un~jF9DztOx)HynX`P2XksTOz!Z5tj}Y{{nIGN(xr8M^vMlO5GO?[B8U-N-X');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');