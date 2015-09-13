<?php

/**
 * @testCase
 */

namespace KdybyTests\FiMath\Elementary\Operation;

use FiMath;
use FiMath\Elementary\Operation as Op;
use FiMath\Elementary\Type\Subtraction;
use FiMath\Elementary\Type\Decimal;
use FiMath\Elementary\Type\Multiplication;
use FiMath\Elementary\Type\Addition;
use FiMath\ProblemTree\NodeCollector;
use Tester;
use Tester\Assert;



require_once __DIR__ . '/../../../bootstrap.php';



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class SubtractionTest extends Tester\TestCase
{

	/**
	 * (1 + 2) * (4 - (3 + 2))
	 */
	public function dataReplaceNode()
	{
		$t = new Multiplication(
			$l = new Subtraction(
				$ll = new Decimal(1),
				$lr = new Decimal(2)
			),
			$r = new Addition(
				$rl = new Decimal(4),
				$rr = new Subtraction(
					$rrl = new Decimal(3),
					$rrr = new Decimal(2)
				)
			)
		);

		return get_defined_vars();
	}



	public function testFindCandidates()
	{
		$nodes = $this->dataReplaceNode();
		$tree = (new NodeCollector())->collect($nodes['t']);

		$op = new Op\Subtraction();
		Assert::same([
			$nodes['rr'],
			$nodes['l'],
		], iterator_to_array($op->findCandidates($tree)));
	}



	public function testApply_left()
	{
		$nodes = $this->dataReplaceNode();
		$tree = (new NodeCollector())->collect($nodes['t']);

		$op = new Op\Subtraction();
		/** @var Multiplication $newTree */
		$newTree = $op->apply($nodes['l'], $tree);

		Assert::notSame($nodes['t'], $newTree);
		Assert::type(Multiplication::class, $newTree);

		Assert::equal(new Decimal('-1'), $newTree->getLeft());
		Assert::same($nodes['r'], $newTree->getRight());
	}

}



(new SubtractionTest())->run();
