# Dice wrapper - PHP Dependency Injection Container

[![License](https://poser.pugx.org/pattisahusiwa/dice-wrapper/license)](//packagist.org/packages/pattisahusiwa/dice-wrapper)
[![Latest Stable Version](https://poser.pugx.org/pattisahusiwa/dice-wrapper/v)](//packagist.org/packages/pattisahusiwa/dice-wrapper)
[![Latest Unstable Version](https://poser.pugx.org/pattisahusiwa/dice-wrapper/v/unstable)](//packagist.org/packages/pattisahusiwa/dice-wrapper)

PSR-11 compliant for [Level-2/Dice](https://github.com/Level-2/Dice) dependency injection container.

Dice is a minimalist Dependency Injection Container for PHP with a focus on being lightweight and fast as well as requiring as little configuration as possible.

## Installation
Use composer to install the package.
````bash
composer require pattisahusiwa/dice-wrapper
````

## Usage
Please check [Dice documentation](https://github.com/Level-2/Dice) for detail usage.

````php
// Create new Dice instance
$dice = new Dice();

// You can also pass your dependencies configuration into Dice instance
$dice = $dice->addRules('rules.json');

// Pass dice instance to DiceWrapper
$diceWrapper = new DiceWrapper($dice);

// example usage
if ($diceWrapper->has('class_name')) {
  $object = $diceWrapper->get('class_name');
}
````

## Limitations
You can't use `DICE::SELF` in order to get `DiceWrapper` instance. `DICE::SELF` will return `Dice` instance.


## Contributing
All form of contributions are welcome. You can [report issues](https://github.com/pattisahusiwa/dice-wrapper/issues), fork the repo and submit pull request.

## License
See the [LICENSE](https://github.com/pattisahusiwa/dice-wrapper/blob/master/LICENSE) file.
