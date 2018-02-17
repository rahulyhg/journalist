<?php

/**
 * Class JN_Core
 */

// Classes

require __DIR__ . '/JN_Config.php';

require __DIR__ . '/JN_Request.php';

require __DIR__ . '/JN_Response.php';

require __DIR__ . '/JN_Url.php';

require __DIR__ . '/JN_Template.php';

require __DIR__ . '/JN_Database.php';

require __DIR__ . '/JN_Settings.php';

// Models

require __DIR__ . '/models/Post.php';

require __DIR__ . '/models/Setting.php';

/**
 * Class JN_Core
 */

class JN_Core {

	public $config;

	public $request;

	public $url;

	public $response;

	public $template;

	/** @var JN_Settings */

	public $settings;

	/**
	 * Page data
	 */

	private $page;

	private $post;

	private $pageTemplate = 'index';

	/**
	 * JN_Core constructor.
	 */

	public function __construct() {

		$this->config = new JN_Config();

		$this->request = new JN_Request();

		$this->url = new JN_Url();

		$this->response = new JN_Response();

		$this->template = new JN_Template();

		/**
		 *
		 */

		$this->database = new JN_Database($this->config->getDatabaseCredentials(), $this->config->isDebugMode());

		$this->template->setDebugMode($this->config->isDebugMode());

		$this->getSettings();
	}

	/**
	 * Get all settings
	 */

	private function getSettings() {

		$options = $this->database->em->getRepository(Setting::class)->findAll();

		$this->settings = new JN_Settings($options);
	}

	/**
	 * Get Page data
	 */

	public function getPostData() {

		$postRepository = $this->database->em->getRepository(Post::class);

		if($this->url->getUrl() == '/') {

			$post = $postRepository->find($this->settings->get('homepage'));

		} else {

			$post = $postRepository->findOneBy([
				'post_type' => 'post',
				'slug' => $this->url->getUrl()
			]);

			if(!$post) {

				$post = $postRepository->findOneBy([
					'post_type' => 'page',
					'slug' => $this->url->getUrl()
				]);

				if(!$post) {

					$this->response->setResponse('404', 'Not found');

					$this->setPageTemplate('404');
				}
			}

		}

		$this->post = $post;
	}

	/**
	 * Resolve template
	 *
	 * @throws Twig_Error_Loader
	 * @throws Twig_Error_Runtime
	 * @throws Twig_Error_Syntax
	 */

	public function resolveTemplate() {

		// Language

		$this->template->registerFunction('jn_lang', function() {

			return 'cs';
		});

		// Title

		$this->template->registerFunction('jn_title', function() {

			return ((isset($this->post)) ? $this->post->title : 'Stránka nenalezena') . ' &laquo; ' . $this->settings->get('page_title');
		});

		// Get Header and footer

		$this->template->resolveTemplate();

		$this->template->setPostData($this->post);
	}

	/**
	 * Set page template
	 */

	private function setPageTemplate($name) {

		$this->pageTemplate = $name;
	}

	/**
	 * Get page content
	 */

	public function getContent() {

		$this->response->send();

		return $this->template->getPageContent($this->pageTemplate);
	}

}