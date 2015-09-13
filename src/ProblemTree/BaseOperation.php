<?php

namespace FiMath\ProblemTree;

use FiMath\Node;
use FiMath\Operation;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
abstract class BaseOperation implements Operation
{

	/**
	 * @var NodeReplacer
	 */
	protected $replacer;



	public function __construct(NodeReplacer $replacer = NULL)
	{
		$this->replacer = $replacer ?: new NodeReplacer();
	}


	/**
	 * Analyze the tree and find candidates for the transformation.
	 * First are returned the most deep Elements in the Tree.
	 *
	 * @param CollectionResult $tree
	 * @return Node[]|\Traversable
	 */
	abstract public function findCandidates(CollectionResult $tree);



	/**
	 * Apply the transformation on the subtree.
	 * Returns root element of completely new tree, with applied modifications.
	 *
	 * @param Node $element
	 * @param CollectionResult $tree
	 * @return Node $element
	 */
	public function apply(Node $element, CollectionResult $tree)
	{
		return $this->replacer->replaceNode($element, $this->calculateReplacement($element, $tree), $tree);
	}



	/**
	 * @param Node $element
	 * @param CollectionResult $tree
	 * @return mixed
	 */
	abstract protected function calculateReplacement(Node $element, CollectionResult $tree);

}
