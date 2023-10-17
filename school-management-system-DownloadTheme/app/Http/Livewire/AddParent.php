<?php

namespace App\Http\Livewire;

use App\Blood;
use App\Nationality;
use App\Religion;
use Livewire\Component;

class AddParent extends Component
{
    public  $currentStep = 1,
    $Email, $Password,
    $Name_Father, $Name_Father_en,
    $National_ID_Father, $Passport_ID_Father,
    $Phone_Father, $Job_Father, $Job_Father_en,
    $Nationality_Father_id, $Blood_Type_Father_id,
    $Address_Father, $Religion_Father_id,

    // Mother_INPUTS
    $Name_Mother, $Name_Mother_en,
    $National_ID_Mother, $Passport_ID_Mother,
    $Phone_Mother, $Job_Mother, $Job_Mother_en,
    $Nationality_Mother_id, $Blood_Type_Mother_id,
    $Address_Mother, $Religion_Mother_id;
    public function render()
    {
        return view('livewire.add-parent',[
            'Nationalities'=>Nationality::all(),
            'Type_Bloods'=>Blood::all(),
            'Religions'=>Religion::all()
        ]);
    }

    public function firstStepSubmit(){
$this->currentStep=2;
    }

   public function back($n){
    $this->currentStep=$n;
   }


   public function secondStepSubmit(){
    $this->currentStep=3;
   }
}
