<?php

/**
 * Class JN_Template
 */

class JN_Template {

	private $templateTwig;

	private $pageTwig;

	public function __construct($theme = 'default') {

		$loader = new Twig_Loader_Filesystem(ROOT_PATH .'/themes/' . $theme . '/');

		$twig = new Twig_Environment($loader, array(
			'cache' => ROOT_PATH . '/temp/cache/volt',
			'debug' => true,
			'autoescape' => false
		));

		$function = new Twig_SimpleFunction('jn_lang', function () {
			return 'cs';
		});

		$twig->addFunction($function);
		$function = new Twig_SimpleFunction('jn_title', function () {
			return 'Titulek';
		});

		$twig->addFunction($function);

		$function = new Twig_SimpleFunction('jn_header', function () {
			return '';
		});

		$twig->addFunction($function);

		$function = new Twig_SimpleFunction('jn_footer', function () {
			return '';
		});

		$twig->addFunction($function);

		$function = new Twig_SimpleFunction('jn_body_class', function () {
			return '';
		});

		$twig->addFunction($function);

		$this->templateTwig = $twig;

	}

}