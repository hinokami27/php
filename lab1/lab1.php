<?php

enum Specialization: string {
    case FAMILY_MEDICINE = "Family medicine";
    case CARDIOLOGY = "Cardiology";
    case NEUROLOGY = "Neurology";
    case RADIOLOGY = "Radiology";
}

trait Treatable {
    public function diagnose(Patient $patient, string $diagnosis):void {
        $patient->medicalHistory[] = $diagnosis;
    }
}

class Patient {
    use Treatable;
    public int $id;
    public string $name;
    public array $medicalHistory = [];
    public array $treatmentHistory = [];

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }
    public function printPatient(): void {
        $info = "Patient |";
        $info .= "ID: {$this->id} |";
        $info .= "Name: {$this->name} |";
        $info .= "Diagnoses: " . implode(', ', $this->medicalHistory) . "\n";
        $info .= "| Treatments: " . implode(', ', $this->treatmentHistory) . "\n";
        $info .= "<br> <br>";
        echo $info;
    }
    public function getMedicalHistory(): array{
        return $this->medicalHistory;
    }
}
abstract class Doctor {
    use Treatable;
    public string $id;
    public string $name;
    public Specialization $specialization;
    public int $experience;
    public array $patients = [];

    public function __construct(string $id, string $name, Specialization $specialization, int $experience) {
        $this->id = $id;
        $this->name = $name;
        $this->specialization = $specialization;
        $this->experience = $experience;
    }
    public function addPatient(Patient $patient): void {
        $this->patients[$patient->id] = $patient;
    }
    public function printPatients(): void {
        foreach ($this->patients as $patient) {
            $patient->printPatient();
        }
    }
}

class FamilyDoctor extends Doctor {
    public function __construct(string $id, string $name, int $experience){
        parent::__construct($id, $name,Specialization::FAMILY_MEDICINE, $experience);
    }
    public function refer(Patient $patient, array $doctors, Specialization $specialization): Doctor{
        $best = null;
        $max = 0;
        foreach($doctors as $doctor){
            if($doctor->experience > $max && $doctor->specialization === $specialization){
                $max = $doctor->experience;
                $best = $doctor;
            }
        }
        if(isset($best->patients[$patient->id])){
            echo "<br>Patient already referred to doctor $best->name <br>";
        }
        else{
            $best->addPatient($patient);
        }
        return $best;
    }
}
class Specialist extends Doctor {
    public function __construct(string $id, string $name,Specialization $specialization, int $experience){
        parent::__construct($id, $name, $specialization, $experience);
    }
    public function treatPatient(Patient $patient, string $treatment): void {
        $patient->treatmentHistory[] = $treatment;
        $patient->printPatient();
        unset($this->patients[$patient->id]);
    }
}
// Create patients
$john = new Patient(1, "John Doe");
$jane = new Patient(2, "Jane Smith");

// Create doctors
$familyDoctor = new FamilyDoctor("D001", "Dr. Brown", 12);
$cardiologist1 = new Specialist("D002", "Dr. Heart", Specialization::CARDIOLOGY,8);
$cardiologist2 = new Specialist("D003", "Dr. Pulse",  Specialization::CARDIOLOGY,15);
$neurologist = new Specialist("D004", "Dr. Brain",  Specialization::NEUROLOGY,10);

// Add patient to family doctor
$familyDoctor->addPatient($john);
$familyDoctor->diagnose($john, 'High blood pressure');
// Print before referral
$familyDoctor->printPatients();

// Refer John to cardiologist (most experienced one)
$treatingDoctor = $familyDoctor->refer($john, [$cardiologist1, $cardiologist2, $neurologist], Specialization::CARDIOLOGY);
echo "Referred patient with id $john->id to doctor $treatingDoctor->name\n";

// Refer the same patient again (should return that patient is already referred)
$treatingDoctor = $familyDoctor->refer($john, [$cardiologist1, $cardiologist2, $neurologist], Specialization::CARDIOLOGY);

$treatingDoctor->printPatients();

if ($treatingDoctor instanceof Specialist) {
    $treatingDoctor->treatPatient($john, 'Beta-blockers');
}

// Print specialists’ patients after referral
$treatingDoctor->printPatients();

// Show John’s medical history
echo "Medical history of {$john->name}: <br>";
foreach ($john->getMedicalHistory() as $record) {
    echo "- $record\n";
}