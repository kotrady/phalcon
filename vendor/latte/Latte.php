<?php
use Latte\Compiler;

//use Nette\Caching\IStorage;

class Latte extends \Phalcon\Mvc\View\Engine implements \Phalcon\Mvc\View\EngineInterface {
    /** @var \Latte\Engine */
    protected $latte;

    /** @var IStorage */
    protected $cacheStorage;

    /**
     * @return \Latte\Engine
     */
    public function getLatte() {
        return $this->latte;
    }

    /**
     * @param \Latte\Engine $latte
     */
    public function setLatte($latte) {
        $this->latte = $latte;
    }

    /**
     * Adapter constructor
     *
     * @param \Phalcon\Mvc\ViewInterface $view
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function __construct($view, \Phalcon\DiInterface $dependencyInjector = null) {
        $this->latte = new \Latte\Engine;
        parent::__construct($view, $dependencyInjector);
    }

    /**
     * @return Compiler
     */
    public function getCompiler() {
        return $this->latte->getCompiler();
    }


//    public function setCacheStorage(IStorage $storage)
//    {
//        $this->cacheStorage = $storage;
//        return $this;
//    }

    /**
     * Sets path to temporary directory.
     * @return self
     */
    public function setTempDirectory($path) {
        $this->latte->setTempDirectory($path);
        return $this;
    }

    /**
     * Renders a view using the template engine
     *
     * @param string $path
     * @param array $params
     * @param boolean $mustClean
     */
    public function render($path, $params, $mustClean = false) {

        if (!isset($params['content'])) {
            $params['content'] = $this->_view->getContent();
        }

        if ($this->cacheStorage) {
            $params['netteCacheStorage'] = $this->cacheStorage;
        }

        $content = $this->latte->renderToString($path, $params);

        if ($mustClean) {
            $this->_view->setContent($content);
        } else {
            echo $content;
        }
    }
}
