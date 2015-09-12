<?php

/**
 * @testCase
 */

namespace KdybyTests\FiMath;

use FiMath\Elementary\Type\Decimal;
use FiMath;
use FiMath\ProblemTree\CollectionResult;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class CollectionResultTest extends Tester\TestCase
{

	public function testEmpty()
	{
		$result = new CollectionResult([], [], []);
		Assert::false($result->hasType(Decimal::class));
		Assert::same([], $result->getByType(Decimal::class));

		Assert::exception(function () use ($result) {
			iterator_to_array($result->getParents(new Decimal(1)));
		}, FiMath\InvalidArgumentException::class, 'The given element is not in this result');
	}

}

(new CollectionResultTest())->run();
