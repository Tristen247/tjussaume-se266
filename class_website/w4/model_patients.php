<?php

include __DIR__ . '/db.php'; 


function GetPatients() {

    global $db;

    $results = [];

    $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried FROM patients ORDER BY id;");

    if ($stmt->execute() && $stmt->rowCount() > 0 ) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return ($results);
    

}

function addPatient ($fName, $lName, $married) {
    global $db;

    
    $stmt = $db->prepare("INSERT INTO patients set patientFirstName = :patientFirstName, patientLastName = :patientLastName, patientMarried = 0");
    $binds = array(
        ":patientFirstName" => $fName,
        ":patientLastName" => $lName,
        ":patientMarried" => $married,
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0){
        $results = "Data Added";
    }

    return ($results);
}

$patients = GetPatients();
$patient = $patients[0];
echo $patient["patientFirstName"];




?>