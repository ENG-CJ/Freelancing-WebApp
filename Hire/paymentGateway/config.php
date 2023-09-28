<?php 

require ('stripe-php-master/init.php');
// require("./stripe-php-master/init.php");



$publishableKey="pk_test_51Mm1RoG2qXu9XHn7MZAHwUNEFg1wh1Ig1UJsho2LeYLBwec5CPOr3Jc3k4gUcnsmAnc8L1WvXg0Majg6s4IHsCmo00t9V5VdYv";
$secretKey="sk_test_51Mm1RoG2qXu9XHn7TfsG8CqP3xKkbnDqHJQEw2yrrfOrtNf69H0KJEthzVIba9FpTeiK33SlWst80f9AA8Q3Vtdw00VnHkUy06";

\Stripe\Stripe::setApiKey($secretKey);



?>