<?php

/*
 * This file is part of oh-my-pmmp.
 * (c) thebigcrafter <hello.thebigcrafter@gmail.com>
 * This source file is subject to the GPL-3.0 license that is bundled
 * with this source code in the file LICENSE.
 */

declare(strict_types=1);

namespace thebigcrafter\OhMyPMMP\async;

use CurlHandle;
use Exception;
use pocketmine\utils\InternetException;
use pocketmine\utils\InternetRequestResult;
use React\Promise\Deferred;
use React\Promise\Promise;
use React\Promise\PromiseInterface;
use function curl_close;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_setopt;
use function curl_setopt_array;
use function round;
use const CURLINFO_CONTENT_LENGTH_DOWNLOAD;
use const CURLOPT_FOLLOWLOCATION;
use const CURLOPT_NOBODY;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_SSL_VERIFYPEER;

class Internet {
	/**
	 * Fetch a resource from the specified URL asynchronously.
	 *
	 * @param string $url The URL from which to fetch the resource.
	 * @return PromiseInterface<string> A promise that resolves with the fetched resource as a string,
	 *                                 or rejects with an InternetException if there's an error.
	 */
	public static function fetch(string $url) : PromiseInterface {
		$deferred = new Deferred();

		try {
			$res = \pocketmine\utils\Internet::getURL($url);
			if ($res instanceof InternetRequestResult) {
				$deferred->resolve($res->getBody());
			}
		} catch (InternetException $e) {
			$deferred->reject($e);
		}

		return $deferred->promise();
	}

	/**
	 *  Get the file size of any remote resource (using curl)
	 *
	 * @return  PromiseInterface<string>
	 * @throws Exception
	 * @license MIT <http://eyecatchup.mit-license.org/>
	 * @url     <https://gist.github.com/eyecatchup/f26300ffd7e50a92bc4d>
	 *
	 * @author  Stephan Schmitz <eyecatchup@gmail.com>
	 */
	public static function getRemoteFilesize(string $url) : PromiseInterface
	{
		$deferred = new Deferred();
		/** @param CurlHandle $ch */
		$ch = curl_init($url);

		if ($ch === false) {
			throw new Exception("Unable url to get remote filesize");
		}

		try {
			curl_setopt_array($ch, [
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_FOLLOWLOCATION => 1,
				CURLOPT_SSL_VERIFYPEER => 0,
				CURLOPT_NOBODY => 1,
			]);

			curl_setopt($ch, CURLOPT_NOBODY, 1);

			curl_exec($ch);
			// content-length of download (in bytes), read from Content-Length: field
			$clen = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

			// cannot retrieve file size, return "-1"
			if (!$clen) {
				$deferred->reject(new Exception("Unable to get remote filesize"));
			}

			$size = $clen;
			switch ($clen) {
				case $clen < 1024:
					$size = $clen . " B";
					break;
				case $clen < 1048576:
					$size = round($clen / 1024, 2) . " KiB";
					break;
				case $clen < 1073741824:
					$size = round($clen / 1048576, 2) . " MiB";
					break;
			}

			$deferred->resolve($size);

			return $deferred->promise();
		} finally {
			curl_close($ch);
		}
	}
}
