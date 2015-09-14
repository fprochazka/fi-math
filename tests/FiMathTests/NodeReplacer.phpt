<?php

/**
 * @testCase
 */

namespace KdybyTests\FiMath;

use FiMath\Elementary\Type\Addition;
use FiMath\Elementary\Type\Decimal;
use FiMath\Elementary\Type\Multiplication;
use FiMath\Elementary\Type\Subtraction;
use FiMath\Engine\NodeCollector;
use FiMath\Engine\NodeReplacer;
use Tester;
use Tester\Assert;



require_once __DIR__ . '/../bootstrap.php';



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class NodeReplacerTest extends Tester\TestCase
{

	/**
	 * (1 + 2) * (4 - (3 + 2))
	 */
	public function dataReplaceNode()
	{
		$t = new Multiplication(
			$l = new Addition(
				$ll = new Decimal(1),
				$lr = new Decimal(2)
			),
			$r = new Subtraction(
				$rl = new Decimal(4),
				$rr = new Addition(
					$rrl = new Decimal(3),
					$rrr = new Decimal(2)
				)
			)
		);

		return get_defined_vars();
	}



	public function testReplaceNode_left()
	{
		$nodes = $this->dataReplaceNode();
		$tree = (new NodeCollector())->collect($nodes['t']);

		/** @var Multiplication $newTree */
		$newTree = (new NodeReplacer())->replaceNode($nodes['l'], $replacement = new Decimal(3), $tree);

		Assert::notSame($nodes['t'], $newTree);
		Assert::type(Multiplication::class, $newTree);

		Assert::same($replacement, $l = $newTree->getLeft());

		Assert::same($nodes['r'], $newTree->getRight());
	}



	public function testReplaceNode_left_left()
	{
		$nodes = $this->dataReplaceNode();
		$tree = (new NodeCollector())->collect($nodes['t']);

		/** @var Multiplication $newTree */
		$newTree = (new NodeReplacer())->replaceNode($nodes['ll'], $replacement = new Decimal(3), $tree);

		Assert::notSame($nodes['t'], $newTree);
		Assert::type(Multiplication::class, $newTree);

		/** @var Addition $l */
		Assert::notSame($nodes['l'], $l = $newTree->getLeft());
		Assert::type(Addition::class, $l);

		Assert::same($replacement, $l->getLeft());

		Assert::same($nodes['lr'], $l->getRight());
		Assert::same($nodes['r'], $newTree->getRight());
	}

}

(new NodeReplacerTest())->run();
