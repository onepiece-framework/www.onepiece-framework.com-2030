<?php
/**	op-skeleton-2030:/asset/init/function/GitHooks.php
 *
 * @created    2026-03-26
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
namespace OP\SKELETON\INIT;

/**	Set the Git hooks
 *
 * @created    2026-03-26
 */
function GitHooks()
{
	//	Set hooks path.
	$hooks_path = _ROOT_GIT_.'/asset/init/hooks/';

	//	Set local hooks.
	Execute("git config core.hooksPath {$hooks_path}");

	//	Set local hooks to submodules.
	Execute("git submodule foreach git config core.hooksPath {$hooks_path}");
}
