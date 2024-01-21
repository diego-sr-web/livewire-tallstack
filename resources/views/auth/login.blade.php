<x-guest-layout>
<!-- Session Status -->
<x-auth-session-status class="login-screen mb-1" :status="session('status')" />  
    <div class="container">
      <div class="login-element">
        <p class="login-title">Boas vindas ao Máquina de vendas</p>
        <p class="login-text">
          Antes de entrar em nossa plataforma, gostaria de solicitar que faço
          o login, com email cadastrado
        </p>

        <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="login-input block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"  placeholder="Digite aqui seu email cadastrado"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="login-input block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            placeholder="Digite aqui sua senha"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="conect-or-reset">
            <div class="conect">
                <div class="check-box-login">
                <label class="custom-checkbox">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="checkmark"></span>
                </label>
                </div>
                <span class="ml-2 text-sm text-gray-600">{{ __('Manter-me Conectado.') }}</span>
            </div>
    
            @if (Route::has('password.request'))
            <a class="forget-password underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Esqueceu a senha?') }}
            </a>
            @endif
          </div>
       
          <button class="login-button">CONECTAR A PLATAFORMA</button>

          <a class="create-account" href="/">
          Não possui acesso ao produto? Clique aqui e saiba mais.
         </a>
        </div>
   
        <div class="login-image"></div>
        
        </form> 
    </div>
</x-guest-layout>
