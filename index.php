<html>
<body>
<!--

Click on 'Fork' in the right top corner, so you can start editing files.

On the left, you can find an icon of a paper page which represents a file explorer.

All challenges can be found under `src/Challenge[number]`.

Additionally for some challenges, we implemented dependecy container where you can get
or set implementation of a class or interface. The same container also injects constructor
dependencies automatically for you.

Challenge 1
All test assertions are in a comment section, but of course you can look at the test case.

Challenge 2
Just implement same interface proxying methods to laravel event dispatcher and then
through symfony event dispatcher

Challenge 3
Test case will setup the app, then it will call Vendor/boot.php, then App/boot.php
(in that exact order). After that, it will call Vendor/Controller action. Your job
is to add some logic to App/boot.php without changing any files from Vendor/*

-->
<pre>
<?php

require_once 'vendor/autoload.php';

use PHPUnit\TextUI\Command;

echo '<pre>';

$command = new Command();
$command->run(['phpunit', '--debug']);
?>
</pre>
</body>
</html>