<?php

/**
 * @testCase
 */

namespace KdybyTests\FiMath\Elementary\Operation;

use FiMath;
use FiMath\Elementary\Operation as Op;
use FiMath\Elementary\Type\Addition;
use FiMath\Elementary\Type\Decimal;
use FiMath\Elementary\Type\Multiplication;
use FiMath\Elementary\Type\Subtraction;
use FiMath\Engine\NodeCollector;
use Tester;
use Tester\Assert;



require_once __DIR__ . '/../../../bootstrap.php';



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class MultiplicationTest extends Tester\TestCase
{

	/**
	 * (3 * 2) - (4 + (3 * 2))
	 */
	public function dataReplaceNode()
	{
		$t = new Subtraction(
			$l = new Multiplication(
				$ll = new Decimal(3),
				$lr = new Decimal(2)
			),
			$r = new Addition(
				$rl = new Decimal(4),
				$rr = new Multiplication(
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

		$op = new Op\Multiplication();
		Assert::same([
			$nodes['rr'],
			$nodes['l'],
		], iterator_to_array($op->findCandidates($tree)));
	}



	public function testApply_left()
	{
		$nodes = $this->dataReplaceNode();
		$tree = (new NodeCollector())->collect($nodes['t']);

		$op = new Op\Multiplication();
		/** @var Subtraction $newTree */
		$newTree = $op->apply($nodes['l'], $tree);

		Assert::notSame($nodes['t'], $newTree);
		Assert::type(Subtraction::class, $newTree);

		Assert::equal(new Decimal('6'), $newTree->getLeft());
		Assert::same($nodes['r'], $newTree->getRight());
	}

}



(new MultiplicationTest())->run();
