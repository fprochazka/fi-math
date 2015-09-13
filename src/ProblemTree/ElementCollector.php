<?php

namespace FiMath\ProblemTree;

use FiMath\Element;
use FiMath\Elementary\Type\Addition;
use FiMath\Elementary\Type\Decimal;
use FiMath\Elementary\Type\Division;
use FiMath\Elementary\Type\Fraction;
use FiMath\Elementary\Type\Multiplication;
use FiMath\Elementary\Type\Subtraction;
use FiMath\ElementContainer;
use FiMath\ProblemVisitor;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class ElementCollector extends ProblemVisitor
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

	/**
	 * @var Element[]
	 */
	private $queue = [];



	public function collect(Element $rootElement)
	{
		$this->elementsList = $this->elementTypes = $this->elementParent = [];

		$this->queue = [$rootElement];
		while ($element = array_shift($this->queue)) {
			/** @var Element $element */
			$element->accept($this);
		}

		return new CollectionResult($rootElement, $this->elementsList, $this->elementTypes, $this->elementParent);
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
				$this->queue[] = $child;
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
