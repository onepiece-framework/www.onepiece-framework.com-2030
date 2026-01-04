<?php
/**	op-skeleton-model:/asset/init/submodules.php
 *
 * Init Git managed submodule
 *
 * @created    2024-04-16
 * @license    Apache-2.0
 * @package    op-skeleton
 * @subpackage model
 * @copyright  Tomoaki Nagahara
 */

/**	Declare strict type
 *
 */
declare(strict_types=0);

/**	Namespace
 *
 */
namespace OP\SKELETON\INIT;

//	Include
require_once(__DIR__.'/function/GitSubmoduleForeach.php');

//	Get git root.
$git_root = trim(`git rev-parse --show-toplevel`);

//	Set hooks path.
$hooks_path = "{$git_root}/asset/init/hooks/";

//	Change directory to git root.
chdir($git_root);

//	Include op.php
(function($git_root){
	include("{$git_root}/asset/config/op.php");
})($git_root);

//	Download nested submodules.
`git submodule update --init --recursive`;

//	Main repository.
`git config core.hooksPath {$hooks_path}`;

//	Submodules.
`git submodule foreach git config core.hooksPath {$hooks_path}`;

//	Git submodule foreach.
GitSubmoduleForeach( $git_root );

//	Initializing a non-Git managed submodule.
require_once(__DIR__.'/update.php');
