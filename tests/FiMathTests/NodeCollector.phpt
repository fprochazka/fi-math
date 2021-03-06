<?php

/**
 * @testCase
 */

namespace KdybyTests\FiMath;

use FiMath\Elementary\Numbers\RealNumber;
use FiMath\Elementary\Type\Addition;
use FiMath\Elementary\Type\Decimal;
use FiMath\Engine\CollectionResult;
use FiMath\Engine\Node;
use FiMath\Engine\NodeCollector;
use Tester;
use Tester\Assert;



require_once __DIR__ . '/../bootstrap.php';



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class NodeCollectorTest extends Tester\TestCase
{

	/**
	 * @var \FiMath\Engine\NodeCollector
	 */
	private $collector;



	protected function setUp()
	{
		$this->collector = new NodeCollector();
	}



	public function testCollectAddition()
	{
		$el = new Addition($one = new Decimal('1'), $two = new Decimal('2'));
		$elId = CollectionResult::id($el);
		$oneId = CollectionResult::id($one);
		$twoId = CollectionResult::id($two);

		$expectedResult = new CollectionResult($el, [
			$elId => $el,
			$oneId => $one,
			$twoId => $two
		], [
			Addition::class => [
				$elId => $el,
			],
			Node::class => [
				$elId => $el,
				$oneId => $one,
				$twoId => $two,
			],
			Decimal::class => [
				$oneId => $one,
				$twoId => $two,
			],
			RealNumber::class => [
				$oneId => $one,
				$twoId => $two,
			]
		], [
			$oneId => $el,
			$twoId => $el,
		]);

		Assert::equal($expectedResult, $this->collector->collect($el));
	}

}

(new NodeCollectorTest())->run();
