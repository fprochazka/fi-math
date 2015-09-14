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
class AdditionTest extends Tester\TestCase
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



	public function testFindCandidates()
	{
		$nodes = $this->dataReplaceNode();
		$tree = (new NodeCollector())->collect($nodes['t']);

		$op = new Op\Addition();
		Assert::same([
			$nodes['rr'],
			$nodes['l'],
		], iterator_to_array($op->findCandidates($tree)));
	}



	public function testApply_left()
	{
		$nodes = $this->dataReplaceNode();
		$tree = (new NodeCollector())->collect($nodes['t']);

		$op = new Op\Addition();
		/** @var Multiplication $newTree */
		$newTree = $op->apply($nodes['l'], $tree);

		Assert::notSame($nodes['t'], $newTree);
		Assert::type(Multiplication::class, $newTree);

		Assert::equal(new Decimal('3'), $newTree->getLeft());
		Assert::same($nodes['r'], $newTree->getRight());
	}



	public function testApply_right_right()
	{
		$nodes = $this->dataReplaceNode();
		$tree = (new NodeCollector())->collect($nodes['t']);

		$op = new Op\Addition();
		/** @var Multiplication $newTree */
		$newTree = $op->apply($nodes['rr'], $tree);

		Assert::notSame($nodes['t'], $newTree);
		Assert::type(Multiplication::class, $newTree);

		/** @var Subtraction $r */
		Assert::notSame($nodes['r'], $r = $newTree->getRight());
		Assert::type(Subtraction::class, $r);

		Assert::notSame($nodes['rr'], $rr = $r->getRight());
		Assert::equal(new Decimal('5'), $rr);

		Assert::same($nodes['rl'], $r->getLeft());
		Assert::same($nodes['l'], $newTree->getLeft());
	}

}



(new AdditionTest())->run();
