<?php

namespace FiMath\Engine;

/**
 * @author Filip Procházka <filip@prochazka.su>
 */
interface Operation
{

	/**
	 * Analyze the tree and find candidates for the transformation.
	 * First are returned the most deep Elements in the Tree.
	 *
	 * @param CollectionResult $tree
	 * @return Node[]|\Traversable
	 */
	public function findCandidates(CollectionResult $tree);



	/**
	 * Apply the transformation on the subtree.
	 * Returns root element of completely new tree, with applied modifications.
	 *
	 * @param Node $element
	 * @param CollectionResult $tree
	 * @return Node $element
	 */
	public function apply(Node $element, CollectionResult $tree);

}
