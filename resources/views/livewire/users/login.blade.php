<section class="login-screen">
    <div class="container">
        <div class="login-element">
            <p class="login-title">Boas vindas ao Máquina de vendas</p>
            <p class="login-text mb-1">
                Antes de entrar em nossa plataforma, gostaria de solicitar que faço
                o login, com email cadastrado
            </p>

            <div class="mt-2 mb-2">
                <span wire:loading wire.target="login">
                    <x-loading.gif />
                </span>
            </div>

            <form wire:submit.prevent="login">
                <x-input type="text" wire:model.lazy="email" label="E-mail" class="p-4 mb-3 mt-1" />
                <x-input type="password" wire:model.lazy="password" label="Senha" class="p-4 mb-6 mt-1" />

                <div class="conect-or-reset">
                    <x-checkbox id="lg" lg wire:model.defer="remember" label="Manter Conectado" class="text-md font-body"/>
                    
                    <a href="/" class="forget-password">Esqueceu a senha?</a>
                </div>
                
                <x-form.button type="submit" class="uppercase" primary>Conectar à Plataforma</x-form.button>
            </form>
            <a class="create-account" href="/">
                Não possui acesso ao produto? Clique aqui e saiba mais
            </a>
        </div>

        <div class="login-image"></div>
    </div>
</section>    