<?php
class Hero {
    public $name;
    public $health;
    public $maxHealth;

    public function __construct($name, $health = 100) {
        $this->name = $name;
        $this->health = $health;
        $this->maxHealth = $health;
    }

    public function isAlive() {
        return $this->health > 0;
    }

    public function attack(Hero $target) {
        $roll = rand(1, 20);
        $damage = 0;
        $message = "";

        if ($roll == 1) {
            $message = "<strong>{$this->name}</strong> trips over their own feet and MISSES! (Rolled: 1)";
        } elseif ($roll == 20) { 
            $damage = rand(20, 30); 
            $message = "<strong>CRITICAL HIT!</strong> {$this->name} smashes {$target->name} for <strong>$damage</strong> damage!";

        } elseif ($roll >= 8) {
            $damage = rand(5, 15);
            $message = "<strong>{$this->name}</strong> hits {$target->name} for $damage damage. (Rolled: $roll)";

        } else {
            $message = "<strong>{$this->name}</strong> swings but misses. (Rolled: $roll)";

        }

        if ($damage > 0) {
            $target->takeDamage($damage);
        }

        return $message;
    }

    public function takeDamage($amount) {
        $this->health -= $amount;
        if ($this->health < 0) $this->health = 0;
    }
}
?>