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


/**
 * Table tl_page
 */
$GLOBALS['TL_DCA']['tl_page']['metasubpalettes']['browser_auth_module_digest'] = array('browser_auth_digest_realm');

$GLOBALS['TL_DCA']['tl_page']['fields']['browser_auth_digest_realm'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_page']['browser_auth_digest_realm'],
	'exclude'   => true,
	'inputType' => 'text',
	'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
	'sql'       => "varchar(255) NOT NULL default ''"
);
