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

namespace Contao\Auth;

class Digest implements AuthInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function authenticate(\PageModel $rootPage)
	{
		$authorization = \Environment::get('httpAuthorization');

		list($mechanism, $authorization) = preg_split('#\s+#', $authorization, 2);
		if (strtolower($mechanism) == 'digest') {
			var_dump($authorization);
			$parameters = array();
			while (preg_match('#(\w+)=("[^"]+"|[^,]+)#', $authorization, $match)) {
				$authorization = ltrim(substr($authorization, strlen($match[0])), ", ");
				$parameters[$match[1]] = trim($match[2], '"');
			}
			if (
				$parameters['realm'] == $rootPage->browser_auth_digest_realm &&
				$parameters['nonce'] == md5(session_id()) &&
				($parameters['qop'] == 'auth' || $parameters['qop'] == 'auth-int')
			) {
				// *Hint*
				// Digest auth will not work, because it is impossible to
				// validate the digest hash against the php db hash :-(
				header('Content-Type: text/plain');
				var_dump($mechanism, $parameters);
				exit;
			}
		}
		return null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function handle403($pageId, \PageModel $rootPage)
	{
		if ($rootPage->browser_auth_digest_realm) {
			$nonce = md5(session_id());

			$authenticate = <<<EOF
WWW-Authenticate: Digest realm="{$rootPage->browser_auth_digest_realm}",
    qop="auth,auth-int",
    nonce="{$nonce}"
EOF;

			header($authenticate);
			while (ob_end_clean());
			exit;
		}
	}
}
