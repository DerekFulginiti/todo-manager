<?php

 class Person {
   public $f_name;
   public $l_name;
   public $age;
   public $gender;

   public function __construct($f_name, $l_name, $age, $gender) {
     $this->f_name = $f_name;
     $this->l_name = $l_name;
     $this->age    = $age;
     $this->gender = $gender;
     // print 'Inside of the constructor';
   }

   public function __get($name) {
     return $this->$name;
   }

   public function __set($name, $value) {
     $this->$name = $value;
   }

   public function run() {
     print $this->f_name . ' is running';
   }

   public function walk() {
     print $this->f_name . ' is walking';
   }
 }

 $p1 = new Person('Derek', 'Fulginiti', 27, 'Male');
 $p2 = new Person('Soriam', 'Fulginiti', 23, 'Female');
 $p3 = new Person('Jason', 'Randisi', 33, 'Male');
 print $p1->f_name;
 $p1->run();
 print '<br />';
 print $p2->f_name;
 print '<br />';
 print $p3->f_name;
$p1->f_name = 'George';

?>
