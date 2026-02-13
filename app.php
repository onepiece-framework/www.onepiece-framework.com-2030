<?php
/**	op-skeleton-2030:/app.php
 *
 * @genesis    2014-02-24  op-core-5
 * @rebirth    2025-06-08  op-skeleton-2030
 * @license    Apache-2.0
 * @package    op-skeleton-2030
 * @copyright  Tomoaki Nagahara
 */

/**	Declare strict type
 *
 */
declare(strict_types=1);

/**	Namespace
 *
 */
namespace OP;

/**	Used for measuring memory usage.
 *
 */
define('_OP_MEM_USAGE_', memory_get_usage());

/**	Measure the execution time of this app.
 *
 */
define('_OP_APP_START_', microtime(true));

/**	Set the application root path.
 *
 */
switch( PHP_SAPI ){
	case 'cli-server':
		$_SERVER['APP_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
		break;
	case 'cli':
		$_SERVER['APP_ROOT'] = dirname($_SERVER['PWD'].'/'.$_SERVER['SCRIPT_FILENAME']);
		break;
	default:
		$_SERVER['APP_ROOT'] = dirname($_SERVER['SCRIPT_FILENAME']);
	break;
}

/**	Bootstrap process.
 *
 */
if( file_exists( $file = __DIR__.'/asset/bootstrap/index.php' ) ){
	//	Execute
	include_once($file);
}else{
	//	Git submodules have not been initialized.
	include_once(__DIR__.'/asset/init/guidance.php');
}

/**	The app is launched automatically.
 *
 */
OP()->Unit()->App()->Auto();
