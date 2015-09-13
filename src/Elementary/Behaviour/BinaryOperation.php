<?php

namespace FiMath\Elementary\Behaviour;

use FiMath\Node;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
trait BinaryOperation
{

	/**
	 * @var Node
	 */
	private $left;

	/**
	 * @var Node
	 */
	private $right;



	public function __construct(Node $left, Node $right)
	{
		$this->left = $left;
		$this->right = $right;
	}



	/**
	 * @return Node
	 */
	public function getLeft()
	{
		return $this->left;
	}



	/**
	 * @return Node
	 */
	public function getRight()
	{
		return $this->right;
	}



	public function getChildNodes()
	{
		return [
			$this->getLeft(),
			$this->getRight(),
		];
	}

}
