<!-- <?php
$multiDim = array(array(2, 4, 5, 7), array(2, 3, 2, 4), array(4, 2, 4, 6));
for ($i = 0; $i < count($multiDim); $i++) {
    echo count($multiDim[$i]);
    for ($j = 0; $j < count($multiDim[$i]); $j++) {
        echo $multiDim[$i][$j];
        echo " ";
    }
    echo "<br>";
}
?> -->
<?php
class Player
{
    public $name;
    public $speed = 5;
    public $salary;

    function set_name($name)
    {
        $this->name = $name;


    }
    function get_name()
    {
        return $this->name;
    }

    //construct without argument
    // function __construct()
    // {
    //     echo "Hello <br>";

    // }

    //constructor with argument
    function __construct($name, $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }
    function __destruct()
    {
        echo "bye $this->name<br>";

    }




}

// $player1 = new Player();
// $player1->set_name("Pooja");
// echo $player1->get_name();

// $player2 = new Player();
$player3 = new Player("Vivek", 8000000000000000);
$player4 = new Player("Viveks", 80000000000);
echo "The salary of $player3->name is $player3->salary<br>";
echo "The salary of $player4->name is $player4->salary<br>";



?>