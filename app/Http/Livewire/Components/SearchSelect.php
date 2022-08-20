<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class SearchSelect extends Component
{
    public $query;
    public $datas = [];
    public $highlightIndex = 0;
    public $modelName;
    public $emitName;
    public $selectedData;
 
    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->datas) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }
 
    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->datas) - 1;
            return;
        }
        $this->highlightIndex--;
    }
 
    public function updatedQuery()
    {
        $this->datas = $this->modelName::where('name', 'like', '%' . $this->query . '%')
            ->limit(3)
            ->get()
            ->toArray();
    }

    public function selectData($target = null)
    {
        if($target !== null) {
            $this->query = $this->datas[$target]['name'];
            $this->selectedData = $this->datas[$target];
        }else {
            $this->query = $this->datas[$this->highlightIndex]['name'];
            $this->selectedData = $this->datas[$this->highlightIndex];
        }

        $this->emit($this->emitName.'_change', $this->selectedData);
        $this->reset(['datas']);
    }

    public function mount($model = '',String $emitName)
    {
        $this->modelName = $model;
        $this->emitName = $emitName;
    }

    public function render()
    {
        return view('livewire.components.search-select');
    }
}
