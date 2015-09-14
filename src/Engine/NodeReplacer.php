<?php

namespace FiMath\Engine;

/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class NodeReplacer
{

	public function replaceNode(Node $original, Node $replacement, CollectionResult $tree)
	{
		foreach ($tree->getParents($original) as $parent) {
			$replacement = $parent->copyWithReplaced($original, $replacement);
			$original = $parent;
		}

		return $replacement;
	}

}
