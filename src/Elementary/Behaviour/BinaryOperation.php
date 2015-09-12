<?php

namespace FiMath\Elementary\Behaviour;

use FiMath\Element;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
trait BinaryOperation
{

	/**
	 * @var Element
	 */
	private $left;

	/**
	 * @var Element
	 */
	private $right;



	public function __construct(Element $left, Element $right)
	{
		$this->left = $left;
		$this->right = $right;
	}



	/**
	 * @return Element
	 */
	public function getLeft()
	{
		return $this->left;
	}



	/**
	 * @return Element
	 */
	public function getRight()
	{
		return $this->right;
	}



	public function getElements()
	{
		return [
			$this->getLeft(),
			$this->getRight(),
		];
	}

}
