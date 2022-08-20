<?php

namespace App\Http\Livewire\Components\Doctor;

use App\Models\Doctor;
use Livewire\Component;

class Table extends Component
{
    public $doctorDelete = [
        'name' => '',
        'name_as' => '',
    ];
    public $doctorEdit = [
        'name' => '',
        'name_as' => '',
        'title' => '',
        'is_specialist' => false,
    ];
    public $doctor = [
        'name' => '',
        'name_as' => '',
        'title' => '',
        'is_specialist' => false,
    ];

    public $modal = false;
    public $modalEdit = false;
    public $modalDelete = false;
    public $doctors;

    public function editDoctor(Doctor $doctor)
    {
        $this->modalEdit = true;
        $this->doctorEdit = $doctor->toArray();
    }
    
    public function deleteDoctor(Doctor $doctor)
    {
        $this->modalDelete = true;
        $this->doctorDelete = $doctor->toArray();
    }

    public function showModal()
    {
        $this->modal = true;
    }

    public function save()
    {
        Doctor::create($this->doctor);

        $this->renderDoctors();
        $this->modal = false;
        $this->emit('showToast', 'Success add doctor '. $this->doctor['name_as'], 'success');
        $this->reset('doctor');
    }

    public function update()
    {
        Doctor::find($this->doctorEdit['id'])->update($this->doctorEdit);
        
        $this->renderDoctors();
        $this->modalDelete = false;
        $this->emit('showToast', 'Success edit doctor '. $this->doctorEdit['name_as'], 'success');
        $this->reset('doctorEdit');
    }

    public function delete()
    {
        Doctor::find($this->doctorDelete['id'])->delete();
        
        $this->renderDoctors();
        $this->modalDelete = false;
        $this->emit('showToast', 'Success delete doctor '. $this->doctorDelete['name_as'], 'success');
        $this->reset('doctorDelete');
    }

    public function doctor_change(Array $result)
    {
        $this->doctor = $result;
    }

    public function renderDoctors()
    {
        $this->doctors = Doctor::get();
    }

    public function mount()
    {
        $this->doctors = Doctor::get();
    }

    public function render()
    {
        return view('livewire.components.doctor.table');
    }
}
