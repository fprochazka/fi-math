<?php

/**
 * @testCase
 */

namespace KdybyTests\FiMath;

use FiMath\Node;
use FiMath\Elementary\Type\Addition;
use FiMath\Elementary\Type\Decimal;
use FiMath\ProblemTree\CollectionResult;
use FiMath\ProblemTree\NodeCollector;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class NodeCollectorTest extends Tester\TestCase
{

	/**
	 * @var NodeCollector
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
			Node::class => array(
				$elId => $el,
				$oneId => $one,
				$twoId => $two
			),
			Decimal::class => array(
				$oneId => $one,
				$twoId => $two
			),
		], [
			$oneId => $el,
			$twoId => $el,
		]);

		Assert::equal($expectedResult, $this->collector->collect($el));
	}

}

(new NodeCollectorTest())->run();
