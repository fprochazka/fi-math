<?php

namespace FiMath;



interface Exception
{

}



class InvalidArgumentException extends \InvalidArgumentException implements Exception
{

}



class NotSupportedException extends \LogicException implements Exception
{

}
