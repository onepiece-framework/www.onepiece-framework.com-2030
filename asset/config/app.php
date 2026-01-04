<?php
/**	op-skeleton-2030:/asset/config/app.php
 *
 * @created    2019-02-20
 * @license    Apache-2.0
 * @package    op-skeleton-2030
 * @copyright  Tomoaki Nagahara
 */

/**	Declare strict
 *
 */
declare(strict_types=1);

/**	namespace
 *
 */
namespace OP;

/**	Return config array.
 *
 * @created   2019-12-12
 * @return    array        $config
 */
return [
	'title'     => 'The onepiece-framework app skeleton '._OP_APP_BRANCH_,
	'copyright' => "Copyright (C) {$_SERVER['SERVER_NAME']} All Rights Reserved.",
	'app.phtml' =>  OP::isAdmin() ? true: false,
];
