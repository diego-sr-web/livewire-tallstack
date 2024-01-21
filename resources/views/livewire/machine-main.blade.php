<div class="main-home-wrapper">
  @include('layouts.sidebar')
  <!-- Lista as Maquinas -->              
  @if ($count)
  
    @include('livewire.machine-dashboard')
    
  @else
        
    @include('livewire.machine-empty')
  
  @endif
</div>

