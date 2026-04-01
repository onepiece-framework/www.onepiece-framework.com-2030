<?php
/**	op-skeleton-2030:/asset/init/guidance.php
 *
 * @genesis    2024-11-24  op-skeleton-2020
 * @copied     2025-06-08  op-skeleton-2030
 * @license    Apache-2.0
 * @package    op-skeleton-2030
 * @copyright  Tomoaki Nagahara
 */

//	Generate git root.
$git_root = realpath(__DIR__.'/../../').'/';

//	If public_html has not been downloaded yet, the "git:/" becomes the "app:/".
$git_root = $_SERVER['APP_ROOT'].'/';

//	Generate the usage.
$usage    = PHP_EOL;
$usage   .= 'Usage: ' . PHP_EOL;
$usage   .= " 1. cd {$git_root}" . PHP_EOL;
$usage   .= ' 2. php asset/init/submodules.php' . PHP_EOL;
$usage   .= PHP_EOL;

//	...
if( empty($_SERVER['SHELL']) ){
	//	HTML
	include(__DIR__.'/guidance.phtml');
}else{
	//	SHELL
	echo $usage;
}

//	...
exit(__LINE__);
