<?php

namespace App\Http\Livewire\Components\Poli;

use App\Models\Poli;
use Livewire\Component;

class Doctor extends Component
{
    public $doctorDelete = [
        'name' => '',
        'name_as' => '',
    ];

    public $relationship = false;
    public $modal = false;
    public $modalDelete = false;
    public $poli = [];
    public $doctor;
    public $doctors;

    protected $listeners = [
        'showModalDoctor' => 'showModal',
        'doctor_change' => 'doctor_change',
    ];

    public function deleteDoctor(Int $id)
    {
        $this->modalDelete = true;
        $this->poli->doctors()->detach($id);
        
        $this->renderDoctors();
        $this->modalDelete = false;
        $this->emit('showToast', 'Success delete doctor '. $this->doctorDelete['name_as'], 'success');
    }

    public function showModal()
    {
        $this->modal = true;
    }

    public function save()
    {
        $this->poli->doctors()->attach($this->doctor['id']);

        $this->renderDoctors();
        $this->modal = false;
        $this->emit('showToast', 'Success add doctor '. $this->doctor['name_as'], 'success');
        $this->reset('doctor');
    }

    public function doctor_change(Array $result)
    {
        $this->doctor = $result;
    }

    public function renderDoctors()
    {
        $this->doctors = Poli::find($this->poli->id)->doctors;
    }

    public function mount($relationship = false,Poli $poli)
    {
        $this->relationship = $relationship;
        $this->poli = $poli;
        $this->doctors = $poli->doctors;
    }

    public function render()
    {
        return view('livewire.components.poli.doctor');
    }
}
