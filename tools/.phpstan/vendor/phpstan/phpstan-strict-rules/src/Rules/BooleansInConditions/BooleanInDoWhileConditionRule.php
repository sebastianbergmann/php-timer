<?php declare(strict_types = 1);

namespace PHPStan\Rules\BooleansInConditions;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Type\VerbosityLevel;
use function sprintf;

/**
 * @implements Rule<Node\Stmt\Do_>
 */
class BooleanInDoWhileConditionRule implements Rule
{

	private BooleanRuleHelper $helper;

	public function __construct(BooleanRuleHelper $helper)
	{
		$this->helper = $helper;
	}

	public function getNodeType(): string
	{
		return Node\Stmt\Do_::class;
	}

	public function processNode(Node $node, Scope $scope): array
	{
		if ($this->helper->passesAsBoolean($scope, $node->cond)) {
			return [];
		}

		$conditionExpressionType = $scope->getType($node->cond);

		return [
			RuleErrorBuilder::message(sprintf(
				'Only booleans are allowed in a do-while condition, %s given.',
				$conditionExpressionType->describe(VerbosityLevel::typeOnly()),
			))->identifier('doWhile.condNotBoolean')->build(),
		];
	}

}
