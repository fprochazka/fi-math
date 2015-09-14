<?php

namespace FiMath\Engine;

/**
 * Basic unit of problem that is parsed into a tree for transformations.
 *
 * @author Filip Procházka <filip@prochazka.su>
 */
interface Node
{

	/**
	 * @param ProblemVisitor $visitor
	 * @return void
	 */
	public function accept(ProblemVisitor $visitor);



	/**
	 * @return Node[]
	 */
	public function getChildNodes();



	/**
	 * @param Node $original
	 * @param Node $replacement
	 * @return static
	 */
	public function copyWithReplaced(Node $original, Node $replacement);

}
