<?php

namespace Core\Http;

class Request {
	public $url;
	public $method;
	public $query;
	public $ip;
	public $agent;
	public $referer;

	protected $allowedPost = [];
	protected $allowedGet = [];
	protected $allowedServer = [];

	private $data = [];

	function __construct() {
		$this->data = [
			'post'   => $this->sanitizePost($_POST),
			'get'    => $this->sanitizeGet($_GET),
			'server' => $this->sanitizeServer($_SERVER)
		];

		$this->url     = $this->data['server']['REQUEST_URI']     ?: '';
		$this->method  = $this->data['server']['REQUEST_METHOD']  ?: '';
		$this->query   = $this->data['server']['QUERY_STRING']    ?: '';
		$this->ip      = $this->data['server']['REMOTE_ADDR']     ?: '';
		$this->agent   = $this->data['server']['HTTP_USER_AGENT'] ?: '';
		$this->referer = $this->data['server']['HTTP_REFERER']    ?: '';
	}

	public function data($key) {
		return $this->data['get'][$key]
			?: $this->data['post'][$key]
			?: $this->data['server'][$key]
			?: false;
	}

	public function get($key) {
		return $this->data['get'][$key] ?: false;
	}

	public function post($key) {
		return $this->data['post'][$key] ?: false;
	}

	public function server($key) {
		return $this->data['server'][$key] ?: false;
	}

	private function sanitizePost($opts, $allowed = []) {
		return $opts;
	}

	private function sanitizeGet($opts, $allowed = []) {
		return $opts;
	}

	private function sanitizeServer($opts, $allowed = []) {
		return $opts;
	}
}
