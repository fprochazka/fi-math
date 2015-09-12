<?php

namespace FiMath;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
interface ElementContainer extends Element
{

	/**
	 * @return Element[]|ElementContainer[]
	 */
	public function getElements();

}
