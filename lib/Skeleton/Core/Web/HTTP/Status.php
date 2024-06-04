<?php
/**
 * HTTP status code collection
 *
 * @author Gerry Demaret <gerry@tigron.be>
 * @author Lionel Laffineur <lionel@tigron.be>
 */

namespace Skeleton\Core\Http;

class Status {

	public static function __callStatic($method, $args) {
		$statuses = [
			[ 'status' => 100, 'error' => 'Continue' ],
			[ 'status' => 101, 'error' => 'Switching Protocols' ],
			[ 'status' => 102, 'error' => 'Processing (WebDAV)' ],
			[ 'status' => 103, 'error' => 'Early Hints' ],
			[ 'status' => 200, 'error' => 'OK' ],
			[ 'status' => 201, 'error' => 'Created' ],
			[ 'status' => 202, 'error' => 'Accepted' ],
			[ 'status' => 203, 'error' => 'Non-Authoritative Information' ],
			[ 'status' => 204, 'error' => 'No Content' ],
			[ 'status' => 205, 'error' => 'Reset Content' ],
			[ 'status' => 206, 'error' => 'Partial Content' ],
			[ 'status' => 207, 'error' => 'Multi-Status' ],
			[ 'status' => 208, 'error' => 'Already Reported' ],
			[ 'status' => 226, 'error' => 'IM Used' ],
			[ 'status' => 300, 'error' => 'Multiple Choices' ],
			[ 'status' => 301, 'error' => 'Moved Permanently' ],
			[ 'status' => 302, 'error' => 'Found' ],
			[ 'status' => 303, 'error' => 'See Other' ],
			[ 'status' => 304, 'error' => 'Not Modified' ],
			[ 'status' => 305, 'error' => 'Use Proxy Deprecated' ],
			[ 'status' => 306, 'error' => 'Unused' ],
			[ 'status' => 307, 'error' => 'Temporary Redirect' ],
			[ 'status' => 308, 'error' => 'Permanent Redirect' ],
			[ 'status' => 400, 'error' => 'Bad Request' ],
			[ 'status' => 401, 'error' => 'Unauthorized' ],
			[ 'status' => 402, 'error' => 'Payment Required Experimental' ],
			[ 'status' => 403, 'error' => 'Forbidden' ],
			[ 'status' => 404, 'error' => 'Not Found' ],
			[ 'status' => 405, 'error' => 'Method Not Allowed' ],
			[ 'status' => 406, 'error' => 'Not Acceptable' ],
			[ 'status' => 407, 'error' => 'Proxy Authentication Required' ],
			[ 'status' => 408, 'error' => 'Request Timeout' ],
			[ 'status' => 409, 'error' => 'Conflict' ],
			[ 'status' => 410, 'error' => 'Gone' ],
			[ 'status' => 411, 'error' => 'Length Required' ],
			[ 'status' => 412, 'error' => 'Precondition Failed' ],
			[ 'status' => 413, 'error' => 'Payload Too Large' ],
			[ 'status' => 414, 'error' => 'URI Too Long' ],
			[ 'status' => 415, 'error' => 'Unsupported Media Type' ],
			[ 'status' => 416, 'error' => 'Range Not Satisfiable' ],
			[ 'status' => 417, 'error' => 'Expectation Failed' ],
			[ 'status' => 418, 'error' => 'I\'m a teapot' ],
			[ 'status' => 421, 'error' => 'Misdirected Request' ],
			[ 'status' => 422, 'error' => 'Unprocessable Content' ],
			[ 'status' => 423, 'error' => 'Locked' ],
			[ 'status' => 424, 'error' => 'Failed Dependency' ],
			[ 'status' => 425, 'error' => 'Too Early Experimental' ],
			[ 'status' => 426, 'error' => 'Upgrade Required' ],
			[ 'status' => 428, 'error' => 'Precondition Required' ],
			[ 'status' => 429, 'error' => 'Too Many Requests' ],
			[ 'status' => 431, 'error' => 'Request Header Fields Too Large' ],
			[ 'status' => 451, 'error' => 'Unavailable For Legal Reasons' ],
			[ 'status' => 500, 'error' => 'Internal Server Error' ],
			[ 'status' => 501, 'error' => 'Not Implemented' ],
			[ 'status' => 502, 'error' => 'Bad Gateway' ],
			[ 'status' => 503, 'error' => 'Service Unavailable' ],
			[ 'status' => 504, 'error' => 'Gateway Timeout' ],
			[ 'status' => 505, 'error' => 'HTTP Version Not Supported' ],
			[ 'status' => 506, 'error' => 'Variant Also Negotiates' ],
			[ 'status' => 507, 'error' => 'Insufficient Storage' ],
			[ 'status' => 508, 'error' => 'Loop Detected' ],
			[ 'status' => 510, 'error' => 'Not Extended' ],
			[ 'status' => 511, 'error' => 'Network Authentication Required' ],
		];

		$method = strtolower($method);
		if (strpos($method, 'code_') !== 0) {
			throw new \Exception('Invalid method ' . $method);
		}
		$code = substr($method, 5);
		$key = array_search((int)$code, array_column($statuses, 'status'));
		if ($key === false) {
			throw new \Exception('Unsupported code ' . $code);
		}
		$result = $statuses[$key];
		$message = '';
		$exit = true;
		if (isset($args[0]) && empty($args[0]) === false) {
			$message = ' (' . $args[0] . ')';
		}
		if (isset($args[1]) && $args[1] === false) {
			$exit = false;
		}
		$error = $result['error'];

		header('HTTP/1.1 ' . $code . ' ' . $error . $message, true);
		echo $code . ' ' . $error . $message;
		if ($exit) {
			exit();
		}
	}
}
