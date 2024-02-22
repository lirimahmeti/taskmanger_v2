<?php

namespace App\Livewire;

use App\Models\Clients;
use Livewire\Component;
use Livewire\Attributes\Validate;

class JobCreateForm extends Component
{
    #[Validate('required')]
    public $query;

    public $number;

    public $client;

    public $clients;

    public $selectedClient;

    public $notFocused;

    public function mount()
    {
        $this->query = '';
        $this->number = '';
        $this->clients = [];
        $this->client;
        $this->selectedClient = [];
        $this->notFocused = false;
    }

    // me mshef dropdownin per me i selektu klientat nese klikojm jasht input fieldit per emrin e klientit
    public function hideDropdown()
    {
        $this->notFocused = true;
    }

    // me shfaq dropdownin per me i selektu klientat nese klikojm input fieldin per emrin e klientit
    public function showDropdown()
    {
        $this->notFocused = false;
    }

    public function updatedQuery()
    { 
        $this->notFocused = false;

        if($this->query == ''){
            $this->clients = [];
        }

        if($this->query != '' and strlen($this->query) >= 2) {
        $this->clients = Clients::where('name', 'like', '%'. $this->query .'%')
            ->get()
            ->toArray();
        }
    }

    public function selectClient($clientID){
        
        $this->selectedClient = Clients::findOrFail($clientID);

        return redirect()->route('jobs.create')
        ->with('userExists', $this->selectedClient->name)->with('client', $this->selectedClient);
    }


    public function saveClient()
    {
        $this->validate();
        
        //nese numri nuk eshte empty me bo check a egziston naj user me qat nr
        if($this->number != ''){
            $userExists = Clients::where('phone', $this->number)->first();
            
            //kontrollojm se numri dhene a eshte regjistru ma heret ne databaz
            if($userExists) {
                //nese eshte regjistru e bejme return userin me at numer perkats
                return redirect()->route('jobs.create')->with('userExists', 'Klienti me këtë numër egziston')->with('client', $userExists);
            }else{ //nese nuk eshte ne databaz e shtojm klientin e ri
                try{
                    $newRecord = new Clients([
                        'name' => $this->query,
                        'phone' => $this->number,
                    ]);
                    $newRecord->save();
            
                    $lastInsertedClient = Clients::latest()->first();
                }catch (QueryException $e){
                // Handle other database-related errors
                return redirect()->route('jobs.create')->with('error', 'An error occurred while saving the data.');
            }
            return redirect()->route('jobs.create')->with('success', 'Klienti u shtua me sukses')->with('client', $lastInsertedClient);
            }

        }else{//nese useri nuk e ka dhan numrin e telefonit po veq emrin e regjistrojm ne databaz veq me emer
            try{
                $newRecord = new Clients([
                    'name' => $this->query,
                ]);
                $newRecord->save();
        
                $lastInsertedClient = Clients::latest()->first();
            }catch (QueryException $e){
            // Handle other database-related errors
            return session()->flash('error', 'An error occurred while saving the data.');
        }
        return redirect()->route('jobs.create')->with('success', 'Klienti u shtua me sukses')->with('client', $lastInsertedClient);
        }

    }


    public function render()
    {
        return view('livewire.job-create-form');
    }
}
