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
	//	...
	if(!$github = Request('github') ){
		return;
	}

	//	...
	if(!file_exists('.gitmodules')){
		return;
	}

	//	...
	`cp .gitmodules .gitmodules_origin`;

	//	...
	`sed -i -e "s/onepiece-framework/{$github}/g" .gitmodules`;

	//	...
	`git submodule sync`;
}
