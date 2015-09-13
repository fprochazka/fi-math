<?php

namespace FiMath\ProblemTree;

use FiMath\Node;
use FiMath\InvalidArgumentException;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class CollectionResult
{

	/**
	 * @var Node
	 */
	private $root;

	/**
	 * @var Node[] {Id => Node}
	 */
	private $list;

	/**
	 * @var Node[][] {Type => Node[]}
	 */
	private $types;

	/**
	 * @var Node[] {Id => Node}
	 */
	private $parents;



	public function __construct(Node $root, array $elementsList, array $elementTypes, array $elementParents)
	{
		$this->root = $root;
		$this->list = $elementsList;
		$this->types = $elementTypes;
		$this->parents = $elementParents;
	}



	/**
	 * @return Node
	 */
	public function getRoot()
	{
		return $this->root;
	}



	/**
	 * @return \FiMath\Node[]
	 */
	public function getAllElements()
	{
		return array_values($this->list);
	}



	public function hasType($type)
	{
		return !empty($this->types[$type]);
	}



	/**
	 * @param string $type
	 * @return array|Node[]
	 */
	public function getByType($type)
	{
		return isset($this->types[$type]) ? $this->types[$type] : [];
	}



	/**
	 * @param Node $element
	 * @return \Generator|Node[]
	 */
	public function getParents(Node $element)
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
