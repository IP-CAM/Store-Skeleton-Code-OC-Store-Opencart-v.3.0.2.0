<?php
namespace Template;
final class Twig {
	private $twig;
	private $data = array();
	
	public function __construct() {
		// include and register Twig auto-loader
		include_once(DIR_SYSTEM . 'library/template/Twig/Autoloader.php');
		
		\Twig_Autoloader::register();
	}
	
	public function set($key, $value) {
		$this->data[$key] = $value;
	}
	
	public function render($template, $cache = false) {
		// specify where to look for templates
		$loader = new \Twig_Loader_Filesystem(DIR_TEMPLATE);

		// initialize Twig environment
		$config = array('autoescape' => false);

		if ($cache && env('DEBUG', false) === false) {
			$config['cache'] = DIR_CACHE;
		}

		$this->twig = new \Twig_Environment($loader, $config);

		if (env('DEBUG', false) === true) {
            $this->twig->addFunction(new \Twig_SimpleFunction('dd', static fn (...$vars) => dd(...$vars)));
            $this->twig->addFunction(new \Twig_SimpleFunction('dump', static function (...$vars) {
                dump(...$vars);
            }));
        }

		try {
			// load template
			$template = $this->twig->loadTemplate($template . '.twig');
			
			return $template->render($this->data);
		} catch (Exception $e) {
			trigger_error('Error: Could not load template ' . $template . '!');
			exit();	
		}	
	}	
}
