<?php
require_once('stripe-php/init.php');
$publishable_key = "pk_test_51IyAUuSH2PYXHvOAzZ73FiavzEwGO1YtxV7UDq7Mqe1JAwg3AJcRrnEv6ix4eT8NSlZhSTrZUCpbsBbJgUBNIL0E00ERjOTfIM";
$secret_key = "sk_test_51IyAUuSH2PYXHvOA3ikyndmRKaXZ4s1HOkpPJiGq2T6QwXktRXy4vrn1tdWS9krFOtpVpU5adnhaiMPnJuYkROzD00FPEc4Wgm";

\Stripe\Stripe::setApiKey($secret_key);
?>