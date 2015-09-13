<?php

namespace FiMath\Elementary\Numbers;

use Brick\Math\BigDecimal;
use Brick\Math\BigInteger;
use Brick\Math\BigRational;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
interface RealNumber
{

	/**
	 * @return BigInteger|BigDecimal|BigRational
	 */
	public function toNumber();

}
