<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Notify extends Component
{
    public $toasts = [];

    public $colorsType = [
        'default' => 'text-gray-400',
        'success' => 'text-green-400',
        'warning' => 'text-yellow-400',
        'danger' => 'text-red-400',
        'info' => 'text-blue-400',
    ];
    public $ringsType = [
        'default' => 'ring-gray-400',
        'success' => 'ring-green-400',
        'warning' => 'ring-yellow-400',
        'danger' => 'ring-red-400',
        'info' => 'ring-blue-400',
    ];
    public $iconType = [
        'default' => 'text-gray-200 bg-gray-700',
        'success' => 'text-green-200 bg-green-700',
        'warning' => 'text-yellow-200 bg-yellow-500',
        'danger' => 'text-red-200 bg-red-700',
        'info' => 'text-blue-200 bg-blue-700',
    ];

    protected $listeners = [
        'showToast' => 'show',
        'hideToast' => 'hide',
    ];

    public function show(String $msg = 'Example',String $type = 'default',Bool $icon = true)
    {
        $data = [
            'msg' => $msg,
            'type' => $type,
            'icon' => $icon
        ];

        $this->toasts[bin2hex(random_bytes(10))] = $data;
    }

    public function hide(String $index)
    {
        if (array_key_exists($index, $this->toasts)) {
            unset($this->toasts[$index]);
        }
    }

    public function render()
    {
        return view('livewire.components.notify');
    }
}
