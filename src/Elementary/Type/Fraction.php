<?php

namespace FiMath\Elementary\Type;

use Brick\Math\BigRational;
use FiMath\Element;
use FiMath\ProblemTreeVisitor;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Fraction implements Element
{

	/**
	 * @var string
	 */
	private $numerator;

	/**
	 * @var string
	 */
	private $denominator;



	public function __construct($numerator, $denominator)
	{
		$this->numerator = $numerator;
		$this->denominator = $denominator;
	}



	/**
	 * @return string
	 */
	public function getDenominator()
	{
		return $this->denominator;
	}



	/**
	 * @return string
	 */
	public function getNumerator()
	{
		return $this->numerator;
	}



	/**
	 * @return BigRational
	 */
	public function toRational()
	{
		return BigRational::nd($this->getNumerator(), $this->getDenominator());
	}



	public function accept(ProblemTreeVisitor $visitor)
	{
		$visitor->visitFraction($this);
	}

}
