<?php

namespace App\Http\Livewire\Components\Billing;

use App\Models\Poli;
use App\Models\Doctor;
use Livewire\Component;

class Rajal extends Component
{public $renderId = '';

    public $listPasient = [
        'keyword' => '',
        'selected' => '',
        'lists' => [],
        'upAddress' => false,
        'address' => '',
    ];
    public $listTindakan = [
        'keyword' => '',
        'selected' => [],
        'lists' => [],
        'id' => [],
    ];
    public $listPenunjang = [
        'keyword' => '',
        'selected' => [],
        'lists' => [],
        'id' => [],
    ];

    public $dateMasuk = '';
    public $poli = null;
    public $doctor = null;
    public $doctors = [];
    public $tindakan = [];
    public $penunjang = [];
    public $lab = 0;
    public $obat = 0;
    public $bhp = 0;
    public $startTotal = 0;
    public $total = 0;
    public $idCreate = [];
    public $urlCetak = '';
    public $msg = [
        'color' => '',
        'text' => '',
    ];

    public function searchPX() {
        $pasient = [];
        if(strlen($this->listPasient['keyword']) > 0) {
            $pasient = Pasient::search($this->listPasient['keyword'])
                ->offset(0)
                ->limit(5)
                ->get();   
        }

        $this->listPasient['lists'] = $pasient;
    }

    public function selectPasient(Int $id) {
        $pasient = Pasient::findOrFail($id);
        $this->listPasient['selected'] = $pasient;
        if($pasient->address == '') $this->listPasient['upAddress'] = true;
        $this->listPasient['keyword'] = '';
    }

    public function searchTindakan() {
        $tindakan = [];
        if(strlen($this->listTindakan['keyword']) > 0) {
            $tindakan = Billing::selectPoli($this->poli, $this->listTindakan['keyword'])
                ->whereNotIn('id', $this->listTindakan['id'])
                ->offset(0)
                ->limit(5)
                ->get();
        }

        $this->listTindakan['lists'] = $tindakan;
    }

    public function searchPenunjang() {
        $penunjang = [];
        if(strlen($this->listPenunjang['keyword']) > 0) {
            $penunjang = Billing::selectPenunjang($this->listPenunjang['keyword'])
                ->whereNotIn('id', $this->listPenunjang['id'])
                ->offset(0)
                ->limit(5)
                ->get();
        }

        $this->listPenunjang['lists'] = $penunjang;
    }

    public function selectTindakan(Billing $bill) {
        $arr = [
            'id' => $bill['id'],
            'name' => $bill['name'],
            'price' => $bill['price'],
            'qnt' => 1,
        ];
        array_push($this->tindakan, $arr);
        $this->listTindakan['keyword'] = null;
        $this->listTindakan['lists'] = [];
        array_push($this->listTindakan['id'], $bill->id);
        $this->countBill();
    }

    
    public function selectPenunjang(Billing $bill) {
        $arr = [
            'id' => $bill['id'],
            'name' => $bill['name'],
            'price' => $bill['price'],
            'qnt' => 1,
        ];
        array_push($this->penunjang, $arr);
        $this->listPenunjang['keyword'] = null;
        $this->listPenunjang['lists'] = [];
        array_push($this->listPenunjang['id'], $bill->id);
        $this->countBill();
    }

    public function addQntTindakan($index) {
        if($this->tindakan[$index]['qnt'] > 0) $this->tindakan[$index]['qnt']++;
        $this->countBill();
    }

    public function minQntTindakan($index) {
        if($this->tindakan[$index]['qnt'] > 1) $this->tindakan[$index]['qnt']--;
        $this->countBill();
    }

    public function dellTindakan($index) {
        $id = $this->tindakan[$index]['id'];
        foreach ($this->listTindakan['id'] as $key => $value) {
            if($value == $id) unset($this->listTindakan['id'][$key]);
        }
        unset($this->tindakan[$index]);
        $this->countBill();
    }

    public function addQntPenunjang($index) {
        if($this->penunjang[$index]['qnt'] > 0) $this->penunjang[$index]['qnt']++;
        $this->countBill();
    }

    public function minQntPenunjang($index) {
        if($this->penunjang[$index]['qnt'] > 1) $this->penunjang[$index]['qnt']--;
        $this->countBill();
    }

    public function dellPenunjang($index) {
        $id = $this->penunjang[$index]['id'];
        foreach ($this->listPenunjang['id'] as $key => $value) {
            if($value == $id) unset($this->listPenunjang['id'][$key]);
        }
        unset($this->penunjang[$index]);
        $this->countBill();
    }

    public function mount() {
        $this->dateMasuk = Carbon::now()->format('Y-m-d');
    }

    public function save() {
        if($this->listPasient['selected']) {
            if($this->poli) {
                if($this->doctor) {
                    if($this->listPasient['upAddress']) {
                        $px = Pasient::findOrFail($this->listPasient['selected']['id']);
                        $px->update(['address' => $this->listPasient['address']]);
                    }
                    $bill = Bill::create([
                        'type' => 1,
                        'check_in' => $this->dateMasuk,
                        'check_out' => $this->dateMasuk,
                        'obat' => $this->obat,
                        'lab' => $this->lab,
                        'bhp' => $this->bhp,
                        'total' => $this->total,
                        'class' => 3,
                        'approved' => 1,
                        'pasient_id' => $this->listPasient['selected']['id'],
                        'poli_id' => $this->poli,
                    ]);
                    $bill->doctors()->sync([$this->doctor => ['is_rajal' => 1]]);
                    $billings = [];
                    foreach ($this->tindakan as $val) {
                        $billings[$val['id']] = ['qnt' => $val['qnt']];
                    }
                    foreach ($this->penunjang as $val) {
                        $billings[$val['id']] = ['qnt' => $val['qnt']];
                    }
                    $bill->billings()->sync($billings);
                    array_push($this->idCreate, $bill->id);
                    $this->manageMsg('blue', 'Saved '.count($this->idCreate).' data.');
                    $this->rest();
                }else {
                    $this->manageMsg('red', 'Please select doctor first.');
                }
            }else {
                $this->manageMsg('red', 'Please select poli first.');
            }
        }else {
            $this->manageMsg('red', 'Please select pasien first.');
        }
    }

    public function rest() {
        $this->resetExcept(['dateMasuk', 'poli', 'doctor', 'doctors', 'idCreate']);
    }

    public function countBill() {
        $this->total = $this->startTotal;
        // Tindakan
        foreach ($this->tindakan as $value) {
            $this->total += ($value['price'] * $value['qnt']);
        }
        // Tunjangan
        foreach ($this->penunjang as $value) {
            $this->total += ($value['price'] * $value['qnt']);
        }
        if($this->lab == '') $this->lab = 0;
        if($this->obat == '') $this->obat = 0;
        if($this->bhp == '') $this->bhp = 0;
        // Add with jasa perawat
        $this->total += ($this->lab + $this->obat + 20000 + $this->bhp);
    }

    public function updatedLab() {
        $this->countBill();
    }

    public function updatedObat() {
        $this->countBill();
    }

    public function updatedDoctor() {
        if($this->doctor !== '') {
            $this->startTotal = (Doctor::find($this->doctor)->is_specialist == 1) ? 60000 : 35000;
        }

        $this->countBill();
    }

    public function manageMsg($color = 'blue', $msg = "") {
        $this->msg['color'] = $color;
        $this->msg['text'] = $msg;
    }

    public function render()
    {
        $polis = Poli::get(['id', 'name']);
        $this->doctors = Doctor::withPoli($this->poli)->get();
        $this->urlCetak = base64_encode(json_encode($this->idCreate));
        return view('livewire.bill-rajal', compact('polis'));
        // return view('livewire.components.billing.rajal');
        // WzcsMzAsMTYsMTAsOCwxNSw2LDEyLDM5LDI1LDE5LDQyLDksNDAsNDQsMTMsMjEsMTEsMjAsNDcsNSwzNiwxLDM3LDIsMzQsMjgsMyw0LDE0LDE3LDE4LDIyLDIzLDI0LDI2LDI3LDI5LDMxLDMyLDMzLDM1LDM4LDQxLDQzLDQ1LDQ2LDQ4LDQ5LDUwXQ==
    }
}
