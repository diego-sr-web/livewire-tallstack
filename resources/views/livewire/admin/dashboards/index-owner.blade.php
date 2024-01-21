<div class="main-home-wrapper">
    <x-loading.modal wire:loading />
    @include('layouts.sidebar')

    <section class="bg-white dark:bg-gray-900 w-full">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('companies') }}"
                    class="p-8 col-span-2 text-left h-96 bg-[url('https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/bmw-ix.png')] bg-no-repeat bg-cover bg-center bg-gray-500 bg-blend-multiply hover:bg-blend-normal">
                    <h2 class="mb-5 text-5xl font-extrabold tracking-tight leading-tight text-white">Gerenciamento de
                        Empresas
                    </h2>
                    <button type="button"
                        class="inline-flex items-center px-4 py-2.5 font-medium text-center text-white border border-white rounded-lg hover:bg-white hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-700">
                        Gerenciar
                    </button>
                </a>
                <a href=""
                    class="p-8 col-span-2 md:col-span-1 text-left h-96 bg-[url('https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/bmw-m4.png')] bg-no-repeat bg-cover bg-center bg-gray-500 bg-blend-multiply hover:bg-blend-normal">
                    <h2 class="mb-5 max-w-xl text-4xl font-extrabold tracking-tight leading-tight text-white">
                        Gerenciamento
                    </h2>
                    <button type="button"
                        class="inline-flex items-center px-4 py-2.5 font-medium text-center text-white border border-white rounded-lg hover:bg-white hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-700">
                        Gerenciar
                    </button>
                </a>
                <a href="{{ route('permissions') }}"
                    class="p-8 col-span-2 md:col-span-1 text-left h-96 bg-[url('https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/bmw-m6.png')] bg-no-repeat bg-cover bg-center bg-gray-500 bg-blend-multiply hover:bg-blend-normal">
                    <h2 class="mb-5 max-w-xl text-4xl font-extrabold tracking-tight leading-tight text-white">Gerenciar
                        Permissões
                    </h2>
                    <button type="button"
                        class="inline-flex items-center px-4 py-2.5 font-medium text-center text-white border border-white rounded-lg hover:bg-white hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-700">
                        Gerenciar
                    </button>
                </a>
            </div>
        </div>
    </section>
</div>