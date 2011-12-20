<?php
include 'ProtoClass.php';

$proto_person = new ProtoClass();
$proto_person->sayHello = function(ProtoClass $self) {
  echo "Hey, my name is {$self->name}\n";
};

$frank = clone $proto_person;
$frank->name = 'Frank';

$joe = clone $proto_person;
$joe->name = 'Joe';

$meeting = new ProtoClass(array(
  'place' => 'Rodent Island',
  'people' => array(),
  'addPerson' => function(ProtoClass $self, $person) {
    $self->people[] = $person;
  },
  'meetUp' => function(ProtoClass $self) {
    echo "Welcome @ {$self->place}\n";
    echo "Say hello to others!\n\n";

    foreach($self->people as $person) {
      $person->sayHello();
    }
  }
));

$meeting->addPerson($frank);
$meeting->addPerson($joe);
$meeting->meetUp();