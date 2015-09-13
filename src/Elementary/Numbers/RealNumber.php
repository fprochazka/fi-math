<?php

namespace FiMath\Elementary\Numbers;

use Brick\Math\BigNumber;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
interface RealNumber
{

	/**
	 * @return BigNumber
	 */
	public function toNumber();

}
