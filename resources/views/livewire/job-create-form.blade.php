<div class="border p-4">
    <form wire:submit="saveClient">
        <div class="row g-3">
            <div class="col">
                <div>
                    <label for="name">Emri:<span class="text-danger">*</span></label>
                    <input name="name" id="name" class="form-control"
                        type="text"
                        placeholder="Filan Fisteku"
                        wire:model.live="query"
                        required=""
                        autocomplete="off"
                        wire:blur="hideDropdown"
                        wire:click="showDropdown"
                    />
                    @if($query == '' or $notFocused) 
                        <div class="dropdown-menu px-0">
                    @elseif($query != '' and $notFocused == false)
                        <div class="dropdown-menu show" style="max-height: 200px; overflow-y: auto;">
                    @endif
                    @if(count($clients) > 0)
                        @foreach($clients as $c)
                            <button 
                                class="dropdown-item border"
                                onmouseover="this.style.backgroundColor='lightgray'"
                                onmouseout="this.style.backgroundColor='white'"
                                wire:click.prevent="selectClient({{ $c['id'] }})">
                                <span>{{ $c['name'] }}</span> <span>{{ $c['phone']}}</span>
                            </button>
                        @endforeach
                    @elseif(strlen($query) <= 2)
                        <p class="dropdown-item">Shkruaj te pakten 2 karaktere!</p>
                    @elseif(count($clients) < 1 and $query != '')
                        <p class="dropdown-item">No clients found.</p>
                    @endif
                        <div class="dropdown-item" wire:loading>
                            Loading...
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <label for="number">Numri:</label>
                <input class="form-control"
                       type="text"
                       placeholder="044123123"
                       wire:model.live="number"
                       autocomplete="off"
                />
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm text-start mt-3">Shto klientin</button>
    </form>
</div>