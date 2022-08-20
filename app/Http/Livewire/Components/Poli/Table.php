<?php

namespace App\Http\Livewire\Components\Poli;

use App\Models\Poli;
use Livewire\Component;

class Table extends Component
{
    public $poliCreate = [
        'name' => '',
        'status' => false
    ];
    public $poliEdit = [
        'name' => '',
        'status' => false
    ];
    public $poliDelete = [
        'name' => ''
    ];

    public $modalPoliCreate = false;
    public $modalPoliEdit = false;
    public $modalPoliDelete = false;

    public $polis = [];
    public $query = '';

    public function changeStatus(Poli $poli)
    {
        $status = $poli->status == 0 ? 1 : 0;
        $poli->update([
            'status' => $status
        ]);

        $this->renderPoli();
        $this->emit('showToast', 'Success edit status of poli '. $poli->name, 'success');
    }

    public function createPoli()
    {
        $this->modalPoliCreate = true;
    }

    public function editPoli(Poli $poli)
    {
        $this->poliEdit = $poli->toArray();
        $this->modalPoliEdit = true;
    }

    public function deletePoli(Poli $poli)
    {
        $this->poliDelete = $poli->toArray();
        $this->modalPoliDelete = true;
    }

    public function create()
    {
        Poli::create($this->poliCreate);
            
        $this->renderPoli();
        $this->modalPoliCreate = false;
        $this->emit('showToast', 'Success create poli '. $this->poliCreate['name'], 'success');
        $this->reset('poliCreate');
    }

    public function update()
    {
        $poli = Poli::find($this->poliEdit['id'])
            ->update($this->poliEdit);

            
        $this->renderPoli();
        $this->modalPoliEdit = false;
        $this->emit('showToast', 'Success delete poli '. $this->poliEdit['name'], 'success');
        $this->reset('poliEdit');
    }

    public function delete()
    {
        $poli = Poli::find($this->poliDelete['id'])
            ->delete();

            
        $this->modalPoliDelete = false;
        $this->emit('showToast', 'Success delete poli '. $this->poliDelete['name'], 'success');
        $this->renderPoli();
        $this->reset('poliDelete');
    }

    public function updatedQuery()
    {
        $this->renderPoli();
    }

    public function renderPoli()
    {
        $this->polis = Poli::where('name', 'like', '%'. $this->query .'%')
            ->latest()->get();
    }

    public function mount()
    {
        $this->renderPoli();
    }

    public function render()
    {
        return view('livewire.components.poli.table', [
            'polis' => $this->polis,
        ]);
    }
}
