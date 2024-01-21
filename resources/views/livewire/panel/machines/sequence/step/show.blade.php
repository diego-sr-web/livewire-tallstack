<div class="card-render-wrapper-1">            
    <div class="sua-div cursor-move">
        <div class="primeiro_text">{{ $step->name }}</div>
        <div class="segundo_text">{{ $step->description }}</div>
    </div>
    <div class="outer-div">
        <div class="views-like-and-settings-1">
            <div class="g-item">
                <img class="" src="{{ asset('imgs/single-user-select.png') }}">
            </div>
            <div class="">
                <div class="leads-card-text1">{{ $step->leads_reached }}</div>
                <div class="leads-card-text2">Leads alcançados</div>
            </div>
            <div class="g-item">
                <img class="" src="{{ asset('imgs/graph_google_analitycs.png') }}">
            </div>
        </div>
        <div class="views-like-and-settings-2">
            <div class="views-like-2">
                <div class="views-like-2-text">{{ $step->sent }} <span class="views-like-2-text-1">Envios</span></div>
            </div>
            <div class="views-like-2">
                <div class="views-like-2-text">{{ $step->open }}% <span class="views-like-2-text-1"> Abertos</span></div>
            </div>
            <div class="views-like-2">
                <div class="views-like-2-text">{{ $step->clicks }}% <span class="views-like-2-text-1"> Clicks</span></div>
            </div>
        </div>
    </div>
    <div class="div-final2">
        <div>
            <img src="{{ asset('imgs/settings-switches-checkmark.png') }}" alt="Imagem 1">
        </div>
        <div>
            <img src="{{ asset('imgs/single-user-select.png') }}" alt="Imagem 2">
        </div>
        
        <livewire:panel.machines.sequence.step.dropdown :step="$step" />
    </div>
</div>