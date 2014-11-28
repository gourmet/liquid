<?php

namespace Gourmet\Liquid\View;

use Cake\Utility\Inflector;
use Cake\View\Exception\MissingLayoutException;
use Cake\View\Exception\MissingTemplateException;
use Cake\View\View as CakeView;
use Liquid\Template;

class View extends CakeView {

	public $liquid;
	protected $_renderAs = 'file';
	protected $_renderLayoutAs = 'file';

	public function liquid(Template $liquid = null) {
		if (!is_null($liquid)) {
			$this->liquid = $liquid;
		} else if (empty($this->liquid)) {
			$this->liquid = new Template();
			$this->liquid->registerFilter($this);
		}
		return $this->liquid;
	}

	public function render($view = null, $layout = null) {
		if ($this->hasRendered) {
			return;
		}

		if ($view !== false) {
			try {
				$view = $this->_getViewFileName($view);
			} catch (MissingTemplateException $e) {
				$this->_renderAs = 'string';
			}

			$this->_currentType = static::TYPE_VIEW;
			$this->dispatchEvent('View.beforeRender', [$view]);
			$this->Blocks->set('content', $this->_render($view));
			$this->dispatchEvent('View.afterRender', [$view]);
		}

		if ($layout === null) {
			$layout = $this->layout;
		}
		if ($layout && $this->autoLayout) {
			$this->Blocks->set('content', $this->renderLayout('', $layout));
		}
		$this->hasRendered = true;
		return $this->Blocks->get('content');
	}

	public function renderLayout($content, $layout = null) {
		try {
			$layout = $this->_getLayoutFileName($layout);
		} catch (MissingLayoutException $e) {
			$this->_renderLayoutAs = 'string';
		}

		if (empty($layout)) {
			return $this->Blocks->get('content');
		}

		if (empty($content)) {
			$content = $this->Blocks->get('content');
		} else {
			$this->Blocks->set('content', $content);
		}
		$this->dispatchEvent('View.beforeLayout', [$layout]);

		$title = $this->Blocks->get('title');
		if ($title === '') {
			$title = Inflector::humanize($this->viewPath);
			$this->Blocks->set('title', $title);
		}

		$this->_currentType = static::TYPE_LAYOUT;
		$this->Blocks->set('content', $this->_render($layout));

		$this->dispatchEvent('View.afterLayout', [$layout]);
		return $this->Blocks->get('content');
	}

	protected function _evaluate($viewFile, $dataForView) {
		$content = $viewFile;
		if (
			('file' == $this->_renderAs && $this->_currentType == static::TYPE_VIEW)
			|| ('file' == $this->_renderLayoutAs && $this->_currentType == static::TYPE_LAYOUT)
		) {
			$content = file_get_contents($content);
		}

		return $this->liquid()
			->parse($content)
			->render($this->viewVars + $dataForView);
	}

}
