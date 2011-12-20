# ProtoClass

ProtoClass is a simple class which allows to make proto-objects.
It's inspired by proto-languages where the object methods can be replaced during the code run.

## Basic usage

Object of ProtoClass is just a container of public properties. Those which are valid callbacks can be used as an object "method".
It's not the same as proper methods so there's no `$this` to use. Instead the first argument of "method" is `$self` which is the instance of object itself.

## Examples
```php
include 'ProtoClass.php';

$joe = new ProtoClass();
$joe->name = 'Joe';
$joe->hello = function(ProtoClass $self) {
  echo "Hi I'm {$self->name}\n";
};

$joe->hello();

// propeties can be set in constructor
$number = new ProtoClass(array(
  'precision' => 4,
  'round' => function(ProtoClass $self, $number) {
	return round($number, $self->precision);
  }
));

var_dump($number->round(1.23456));
```