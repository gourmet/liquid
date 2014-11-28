<?php

namespace Gourmet\Liquid\Test\View;

use Cake\Controller\Controller;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\TestSuite\TestCase;
use Gourmet\Liquid\View\LiquidView;

class ViewTest extends TestCase {

	public function testRender() {
		$products = [
			[
				'name' => 'CakeFest',
				'price' => 299.00,
				'description' => 'Every summer we hold our annual conference dedicated to CakePHP. For the past 9 years, the framework has been a benchmark for PHP development, providing developers with a full MVC stack solution to build powerful applications which scale. This, coupled with the amazing community backing and thousands of plugins, makes CakePHP the number one choice for those who love code.',
			],
			[
				'name' => 'cake workshop',
				'price' => 199.00,
				'description' => 'Workshop sessions at CakeFest are an ideal way to learn as a beginner with CakePHP, and a great way to get up to speed with the latest versions and innovations within the framework. All this, directly from the core developers themselves!',
			],
		];

		$output = $this->_render(
			'Products',
			'index',
			'default',
			compact('products')
		);

		$strings = [
			'<h2>CakeFest</h2>', '$299', substr($products[0]['description'], 0, 100) . '...',
			'<h2>Cake Workshop</h2>', '$199', substr($products[1]['description'], 0, 100) . '...',
		];

		foreach ($strings as $string) {
			$this->assertContains($string, $output);
		}
	}

	public function testRenderFromStringViewAndLayout() {
		$output = $this->_render(
			'Accounts',
			'Hello {{ name }}',
			"{{ 'content' | fetch }}\n\nThis email was sent automatically.",
			['name' => 'Baker']
		);

		$expected = "Hello Baker\n\nThis email was sent automatically.";
		$this->assertEquals($expected, $output);
	}

	public function testRenderFromStringViewAndFileLayout() {
		$output = $this->_render(
			'Accounts',
			'Hello {{ name }}',
			'default',
			['name' => 'Baker']
		);

		$expected = "Hello Baker\n\nThis email was sent automatically.\n";
		$this->assertEquals($expected, $output);
	}

	protected function _render($name, $view, $layout, $viewVars) {
		$request = new Request();
		$response = new Response();
		$controller = new Controller($request, $response);
		$controller->name = $name;
		$controller->layout = $layout;
		$controller->viewPath = $name;
		$controller->viewClass = 'Gourmet\Liquid\View\View';
		$controller->set($viewVars);

		return $controller->createView()->render($view);
	}
}
