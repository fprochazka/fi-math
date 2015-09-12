<?php

namespace FiMath;

use FiMath\Elementary\Type\Addition;
use FiMath\Elementary\Type\Decimal;
use FiMath\Elementary\Type\Division;
use FiMath\Elementary\Type\Fraction;
use FiMath\Elementary\Type\Multiplication;
use FiMath\Elementary\Type\Subtraction;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class ElementCollector extends ProblemTreeVisitor
{

	/**
	 * @var Element[] {Id => Element}
	 */
	private $elementsList = [];

	/**
	 * @var Element[][] {Type => Element[]}
	 */
	private $elementTypes = [];

	/**
	 * @var ElementContainer[] {Id => ElementContainer}
	 */
	private $elementParent = [];



	public function collect(Problem $problem)
	{
		$this->elementsList = $this->elementTypes = $this->elementParent = [];
		foreach ($problem->getProblemTrees() as $rootElement) {
			$rootElement->accept($this);
		}
	}



	public function hasType($type)
	{
		return !empty($this->elementTypes[$type]);
	}



	/**
	 * @param string $type
	 * @return array|Element[]
	 */
	public function getByType($type)
	{
		return isset($this->elementTypes[$type]) ? $this->elementTypes[$type] : [];
	}



	/**
	 * @param Element $element
	 * @return \Generator|Element[]
	 */
	public function getParents(Element $element)
	{
		while (isset($this->elementParent[$id = self::id($element)])) {
			$element = $this->elementParent[$id];
			yield $element;
		}
	}



	public function visitDecimal(Decimal $decimal)
	{
		$this->insertElement($decimal);
	}



	public function visitFraction(Fraction $fraction)
	{
		$this->insertElement($fraction);
	}



	public function visitAddition(Addition $addition)
	{
		$this->insertElement($addition);
	}



	public function visitSubtraction(Subtraction $subtraction)
	{
		$this->insertElement($subtraction);
	}



	public function visitMultiplication(Multiplication $multiplication)
	{
		$this->insertElement($multiplication);
	}



	public function visitDivision(Division $division)
	{
		$this->insertElement($division);
	}



	private function insertElement(Element $element)
	{
		$this->elementsList[$id = self::id($element)] = $element;

		foreach (self::getAllObjectTypes($element) as $type) {
			$this->elementTypes[$type][$id] = $element;
		}

		if ($element instanceof ElementContainer) {
			foreach ($element->getElements() as $child) {
				$this->elementParent[self::id($child)] = $element;
			}
		}
	}



	/**
	 * @param object $object
	 * @return string[]
	 */
	private static function getAllObjectTypes($object)
	{
		return array_merge(
			[get_class($object)],
			class_parents($object),
			class_implements($object)
		);
	}



	/**
	 * @param object $object
	 * @return string
	 */
	private static function id($object)
	{
		return spl_object_hash($object);
	}

}
