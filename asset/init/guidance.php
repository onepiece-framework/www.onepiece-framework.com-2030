<?php
/**	op-skeleton-2030:/asset/init/guidance.php
 *
 * @genesis    2024-11-24  op-skeleton-2020
 * @copied     2025-06-08  op-skeleton-2030
 * @version    1.0
 * @package    op-skeleton-2030
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

//	Generate git root.
$git_root = realpath(__DIR__.'/../../').'/';

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
