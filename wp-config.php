<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'wordpress' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '0`^%Y.bmB~8DD>3aLC@rzABtj7EyUl=w]b:q8Pb@c[nS,a(JFXr/rKig#1<^ZrMG' );
define( 'SECURE_AUTH_KEY',  ';>0a=sm-u 5m|,{tP?8Yue$$3d$iPNG_w*3u$Ok`L#kYF,!;cp $aIj3G])3Jv2?' );
define( 'LOGGED_IN_KEY',    '})BjV$0,v`Xfz;;AfWs%UHn}t`$Ag,ms4_Q3|kZv4G.:n!;,MM=agpr*{;Uf!cHE' );
define( 'NONCE_KEY',        'v%)zAm)0l)sd|%W6`OW_4$X#8SI0M`)HO4ADU7`N9cL^uWOf8G`Da#znHcs4m^I(' );
define( 'AUTH_SALT',        'Fj!];!uUQ>t9qnxwU@j+C,dTM5O^wuB_44?qD=onI&:m>uuA0RIq1=Ns~cQ&sg`P' );
define( 'SECURE_AUTH_SALT', 'SJG(jPIUCj^pstf0(AvET-Rt3-:6zs>,otT18DQD+3Nf0?%1~L]IKV8C76#3/C`X' );
define( 'LOGGED_IN_SALT',   'Jlk%X8zJ`{Z(pKq }M!u`W1$nZ,Wap-Kt~tBy2c?@SWjjAjZoe}R2`q#?X9KdzPI' );
define( 'NONCE_SALT',       'f:,B>pLjP#Sxdk$@!e 6:$[Y,w!!9Fx/  e0Unug&83]!1u}60BFe6$HO9(DBB28' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
