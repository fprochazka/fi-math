<?php

namespace FiMath;



/**
 * Basic unit of problem that is parsed into a tree for transformations.
 *
 * @author Filip Procházka <filip@prochazka.su>
 */
interface Element
{

	public function accept(ProblemTreeVisitor $visitor);

}
