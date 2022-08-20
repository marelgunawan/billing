<?php

namespace App\Http\Livewire\Components\Poli;

use App\Models\Poli;
use App\Models\Treatment as Model;
use Livewire\Component;

class Treatment extends Component
{
    public $treatment = [
        'name' => '',
        'name_as' => '',
        'price' => '',
        'price_c2' => '',
        'price_c3' => '',
        'type' => '',
        'type_bill' => '',
        'poli_id' => '',
        'wajib' => false,
        'is_paten' => false,
        'order' => null,
    ];
    public $treatmentEdit = [
        'id' => '',
        'name' => '',
        'name_as' => '',
        'price' => '',
        'price_c2' => '',
        'price_c3' => '',
        'type' => '',
        'type_bill' => '',
        'poli_id' => '',
        'wajib' => false,
        'is_paten' => false,
        'order' => null,
    ];
    public $treatmentDelete = [
        'name' => ''
    ];
    
    public $treatments = [];
    public $poli;
    public $relationship = false;
    public $keyword = '';

    public $modalCreateTreatment = false;
    public $modalEditTreatment = false;
    public $modalDeleteTreatment = false;

    public function createTreatment()
    {
        $this->modalCreateTreatment = true;
    }

    public function editTreatment(Model $treatment)
    {
        $this->treatmentEdit = [    
            'id' => $treatment['id'],
            'name' => $treatment['name'],
            'name_as' => $treatment['name_as'],
            'price' => $treatment['price'],
            'price_c2' => $treatment['price_c2'],
            'price_c3' => $treatment['price_c3'],
            'type' => $treatment['type'],
            'type_bill' => $treatment['type_bill'],
            'poli_id' => $treatment['poli_id'],
            'wajib' => $treatment['wajib'],
            'is_paten' => $treatment['is_paten'],
            'order' => $treatment['order'],
        ];
        $this->modalEditTreatment = true;
    }
    
    public function deleteTreatment(Model $treatment)
    {
        $this->treatmentDelete = $treatment->toArray();
        $this->modalDeleteTreatment = true;
    }
    
    public function save()
    {
        $this->treatment['poli_id'] = $this->poli->id;
        $this->treatment['type_bill'] = $this->poli->type;
        
        Model::create($this->treatment);
        $this->renderTreatments();
        $this->modalCreateTreatment = false;
        $this->emit('showToast', 'Success add treatment '. $this->treatment['name_as'], 'success');
        $this->reset('treatment');
    }

    public function update()
    {
        Model::find($this->treatmentEdit['id'])->update($this->treatmentEdit);
        $this->renderTreatments();
        $this->modalEditTreatment = false;
        $this->emit('showToast', 'Success edit treatment '. $this->treatment['name_as'], 'success');
        $this->reset('treatment');
    }

    public function delete()
    {
        Model::find($this->treatmentDelete['id'])->delete();
        $this->renderTreatments();
        $this->modalDeleteTreatment = false;
        $this->emit('showToast', 'Success delete treatment '. $this->treatmentDelete['name'], 'success');
        $this->reset('treatmentDelete');
    }

    public function renderTreatments()
    {
        $this->treatments = Poli::find($this->poli->id)->treatments()->where('name', 'like', '%'. $this->keyword .'%')->get();
    }

    public function mount($relationship = false,Poli $poli)
    {
        $this->relationship = $relationship;
        $this->poli = $poli;
        $this->treatments = $poli->treatments()->where('name', 'like', '%'. $this->keyword .'%')->get();
    }
    
    public function render()
    {
        return view('livewire.components.poli.treatment');
    }
}
