<?php
/**	op-skeleton-model:/asset/init/function/GitSubmoduleGithub.php
 *
 * @created    2026-01-10
 * @license    Apache-2.0
 * @package    op-skeleton
 * @subpackage model
 * @copyright  Tomoaki Nagahara
 */

/**	Declare strict type
 *
 */
declare(strict_types=1);

/**	Namespace
 *
 */
namespace OP\SKELETON\INIT;

/**	Include
 *
 */
require_once(__DIR__.'/Request.php');

/**	Add option repository.
 *
 */
function GitSubmoduleGithub()
{
	//	If submodule not exists then return.
	if(!file_exists('.gitmodules')){
		return;
	}

	//	If specify github account then replace github account in .gitmodules.
	if( $github = Request('github') ){
	//	...
	`cp .gitmodules .gitmodules_origin`;

	//	...
	`sed -i -e "s/onepiece-framework/{$github}/g" .gitmodules`;
	}

	//	Git clone submodules.
	`git submodule sync`;
	`git submodule init`;
	`git submodule update`;
}
