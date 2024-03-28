<?php 

#function the display 1-100 and the word fizz. buzz, and fizzbuzz when applicable
function fizzBuzz($num){

    if ($num %2 == 0 && $num %3 == 0){
        return 'fizzBuzz';
    } elseif ($num %2 == 0) {
        return 'fizz';
    } elseif ($num %3 == 0) {
        return 'buzz';
    } else {
        return $num;
    }

};


?>