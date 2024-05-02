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

//Update the patients info:
function updatePatient($id, $fName, $lName, $married, $bDate) {
    global $db;

    if (!$id || !is_numeric($id)) {
        return 'Invalid patient ID';
    }

    if (!$bDate || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $bDate)) {
        return 'Invalid birthdate format';
    }

    $sql = "UPDATE patients SET 
                patientFirstName = :patientFirstName, 
                patientLastName = :patientLastName, 
                patientMarried = :pMarried, 
                patientBirthDate = :pBDate 
            WHERE id = :id";

    $stmt = $db->prepare($sql);
    $binds = [
        ":patientFirstName" => $fName,
        ":patientLastName" => $lName,
        ":pMarried" => $married,
        ":pBDate" => $bDate,
        ":id" => $id
    ];

    if ($stmt->execute($binds)) {
        if ($stmt->rowCount() > 0) {
            return 'Patient Updated';
        } else {
            return 'No changes made to patient info';
        }
    } else {
        return 'Error updating patient info';
    }
}

//Delete 1 Patient Record:
function deletePatient ($id) {
    global $db;

    $results = "Data was not deleted";
    $stmt = $db->prepare("DELETE FROM patients WHERE id=:id");
    $stmt->bindValue(':id', $id);

    if ($stmt->execute() && $stmt->rowCount() > 0){
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return ($results);
}

//To get 1 Patients information:
function getPatient($id) {
    global $db;

    try {
        $stmt = $db->prepare("SELECT * FROM patients WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("No patient found with ID: $id");
            }
        } else {
            throw new Exception("Query failed to execute for ID: $id");
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false; 
    }
}




?>