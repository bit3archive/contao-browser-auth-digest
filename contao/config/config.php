<?php

/**
 * Digest authentication mechanism for Contao.
 * Copyright (C) 2013 Tristan Lins
 *
 * PHP version 5
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    auth/digest
 * @license    LGPL-3.0+
 * @filesource
 */

// register auth module
$GLOBALS['BROWSER_AUTH_MODULES']['digest'] = 'Contao\Auth\Digest';
