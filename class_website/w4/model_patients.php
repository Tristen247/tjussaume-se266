<?php

include __DIR__ . '/db.php'; 


function GetPatients() {

    global $db;

    $results = [];

    $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients ORDER BY id;");

    if ($stmt->execute() && $stmt->rowCount() > 0 ) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return ($results);
    

}

function addPatient ($fName, $lName, $married, $bDate) {
    global $db;
    
    $stmt = $db->prepare("INSERT INTO patients (patientFirstName, patientLastName, patientMarried, patientBirthDate) VALUES (:patientFirstName, :patientLastName, :pMarried, :pBDate)");

    $binds = array(
        ":patientFirstName" => $fName,
        ":patientLastName" => $lName,
        ":pMarried" => $married,
        ":pBDate" => $bDate
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0){
        $results = "Data Added";
    } else {
        $results = "Error Adding Data";
    }

    return ($results);
}

//$results = addPatient('John', 'Doe', 1);
//$patients = GetPatients();

//var_dump($patients)




?>