<?php

namespace FiMath\ProblemTree;

use FiMath\Element;
use FiMath\ElementContainer;
use FiMath\InvalidArgumentException;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class CollectionResult
{

	/**
	 * @var Element
	 */
	private $root;

	/**
	 * @var Element[] {Id => Element}
	 */
	private $list;

	/**
	 * @var Element[][] {Type => Element[]}
	 */
	private $types;

	/**
	 * @var ElementContainer[] {Id => ElementContainer}
	 */
	private $parents;



	public function __construct(Element $root, array $elementsList, array $elementTypes, array $elementParents)
	{
		$this->root = $root;
		$this->list = $elementsList;
		$this->types = $elementTypes;
		$this->parents = $elementParents;
	}



	/**
	 * @return Element
	 */
	public function getRoot()
	{
		return $this->root;
	}



	public function hasType($type)
	{
		return !empty($this->types[$type]);
	}



	/**
	 * @param string $type
	 * @return array|Element[]
	 */
	public function getByType($type)
	{
		return isset($this->types[$type]) ? $this->types[$type] : [];
	}



	/**
	 * @param Element $element
	 * @return \Generator|Element[]
	 */
	public function getParents(Element $element)
	{
		if (!isset($this->list[$id = self::id($element)])) {
			throw new InvalidArgumentException('The given element is not in this result');
		}

		while (!empty($this->parents[$id])) {
			yield ($element = $this->parents[$id]);
			$id = self::id($element);
		}
	}



	/**
	 * @param object $object
	 * @return string
	 */
	public static function id($object)
	{
		return spl_object_hash($object);
	}

}
