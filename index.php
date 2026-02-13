<?php
require_once 'Hero.php';

// If the output buffer is not started (production servers typically),
// start an output buffer to capture the echos.
if (ob_get_level() == 0) ob_start();

$hero1 = new Hero("Conan", 100);
$hero2 = new Hero("Xena", 100);


echo "<h1>BATTLE START</h1>";
echo "<h3>{$hero1->name} VS {$hero2->name}</h3>";
echo "<hr>";

while ($hero1->isAlive() && $hero2->isAlive()) {
    
    echo "<p>" . $hero1->attack($hero2) . "</p>";
    
    if (!$hero2->isAlive()) break;

    echo "<p>" . $hero2->attack($hero1) . "</p>";

    echo "<small style='color:gray'>STATUS: {$hero1->name} ({$hero1->health} HP) | {$hero2->name} ({$hero2->health} HP)</small>";
    echo "<hr>";

    // Fills the buffer with 4096 bytes (a standard 'chunck' of buffer data) 
    // of empty space to force the browser to render the output.
    // If a browser receives less that 25 bytes, it may wait until more is received
    // before re-rendering the page.
    echo str_pad('', 4096) . "\n";
    
    // Forces what is in the output buffer to 'flush' to the screen/browser
    ob_flush();
    flush();
    
    // Sleep for 1 second, then continue
    sleep(1);
}

echo "<h1>GAME OVER</h1>";

if ($hero1->isAlive()) {
    echo "<h2 style='color:green'>WINNER: {$hero1->name}</h2>";
} else {
    echo "<h2 style='color:green'>WINNER: {$hero2->name}</h2>";
}

echo "<p><a href='index.php'>Fight Again</a></p>";
?>