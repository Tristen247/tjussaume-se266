<?php

#function to dump a value and quick format
function dd($data){
    echo '<pre>';
    die(var_dump($data));
    echo '<pre>';
};

#function to check if older than 21
function validAge($Age) {

    if ($Age >= 21) 
        echo "Thanks, you may enter now.";
    
    else 
        echo "Sorry, you're not old enough";
};
