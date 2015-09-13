<?php

namespace FiMath;



/**
 * Marks a class that contains a context of a problem and should now the ways to solve it.
 *
 * @author Filip Procházka <filip@prochazka.su>
 */
interface Problem
{

	/**
	 * A problem can have more than one problem tree.
	 *
	 * @return Node[]
	 */
	public function getProblemTrees();

}
