<?php
/**	op-skeleton-model:/asset/init/submodules.php
 *
 * Init Git managed submodule
 *
 * <pre>
 * php asset/init/submodules.php github=github_account local=1 dir=ssh:~/repo/
 * </pre>
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
declare(strict_types=1);

/**	Namespace
 *
 */
namespace OP\SKELETON\INIT;

//	Include
require_once(__DIR__.'/function/GitSubmoduleForeach.php');

//	Get main repository path.
define('_ROOT_GIT_', trim(`git rev-parse --show-toplevel`));

//	Change directory to git root.
chdir(_ROOT_GIT_);

//	Include op.php
(function($git_root){
	include("{$git_root}/asset/config/op.php");
})(_ROOT_GIT_);

//	Git submodule foreach.
GitSubmoduleForeach(_ROOT_GIT_);

//	Unit, Module, Layout, WebPack
include(__DIR__.'/update.php');
