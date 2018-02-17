<?php

/**
 * Class JN_Template
 */

class JN_Template {

	private $engine;

	/**
	 * JN_Template constructor.
	 * @throws Twig_Error_Loader
	 * @throws Twig_Error_Runtime
	 * @throws Twig_Error_Syntax
	 */

	public function __construct() {

		$loader = new Twig_Loader_Filesystem(ROOT_PATH .'/app/theme');

		$engine = new Twig_Environment($loader, array(
			'cache' => ROOT_PATH . '/temp/cache/twig',
			'debug' => true,
			'autoescape' => false
		));

		$this->engine = $engine;
	}

	/**
	 * Set debug mode
	 *
	 * @param $bool
	 */

	public function setDebugMode($bool) {

		if($bool)
			$this->engine->enableDebug();
		else
			$this->engine->disableDebug();
	}

	/**
	 * Register functions
	 */

	public function registerFunction($name, $function) {

		if(!is_callable($function))
			throw new Exception();

		$this->engine->addFunction(new Twig_SimpleFunction($name, $function));
	}

	private $header;

	private $footer;

	/**
	 * Resolve header and footer
	 *
	 * @throws Twig_Error_Loader
	 * @throws Twig_Error_Runtime
	 * @throws Twig_Error_Syntax
	 */

	public function resolveTemplate() {

		$engine = clone $this->engine;

		$this->header = $this->engine->render('header.twig');

		$this->footer = $this->engine->render('footer.twig');

		/**
		 * Set content methods
		 */

		$this->engine = $engine;

		$this->registerFunction('get_header', function() { return $this->header; });

		$this->registerFunction('get_footer', function() { return $this->footer; });

	}

	public function setPageData($page) {

		$this->registerFunction('title', function() use($page) {

			return $page->title;
		});

		$this->registerFunction('content', function() use($page) {

			return $page->content;
		});
	}

	/**
	 * Get page content
	 *
	 * @param $file
	 * @param array $data
	 *
	 * @return string
	 * @throws Twig_Error_Loader
	 * @throws Twig_Error_Runtime
	 * @throws Twig_Error_Syntax
	 */

	public function getPageContent($file, Array $data) {

		return $this->engine->render($file . '.twig', $data);
	}

}