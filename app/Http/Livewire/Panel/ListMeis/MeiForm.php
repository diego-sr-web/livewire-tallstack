<?php

namespace App\Http\Livewire\Panel\ListMeis;

use App\Models\Meis\Mei;
use LivewireUI\Modal\ModalComponent;

class MeiForm extends ModalComponent
{
    public $mei;
    public $mei_cnpj;
    public $mei_nome;
    public $mei_email;
    public $mei_telefone;
    public $mei_entregue;
    public $mei_cep;
    public $mei_situacao;
    public $mei_status;
    public $mei_ano;
    public $mei_endereco;
    public $mei_numero;
    public $mei_complemento;
    public $mei_bairro;
    public $mei_cidade;
    public $mei_uf;
    public $mei_cnae;
    public $mei_cnae_desc;

    public $isEdit = false;

    protected $rules = [  
        'mei_cnpj' => 'required|string|min:14|max:25', 
        'mei_nome' => 'required|string|max:100',
        'mei_email' => 'nullable|email|max:100',
        'mei_telefone' => 'nullable|string|max:20',
        'mei_entregue' => 'nullable|integer',
        'mei_cep' => 'nullable|string|max:20',
        'mei_situacao' => 'nullable|string|max:45',
        'mei_status' => 'nullable|integer',
        'mei_ano' => 'nullable|integer',
        'mei_endereco' => 'nullable|string|max:100',
        'mei_numero' => 'nullable|string|max:45',
        'mei_complemento' => 'nullable|string|max:45',
        'mei_bairro' => 'nullable|string|max:45',
        'mei_cidade' => 'nullable|string|max:45',
        'mei_uf' => 'nullable|string|max:2',
        'mei_cnae' => 'nullable|string|max:15',
        'mei_cnae_desc' => 'nullable|string|max:255',

    ];

    public function mount(Mei $mei = null, $isEdit)
    {
        if ($isEdit) {
            $this->mei = $mei;
            $this->mei_cnpj = $mei->mei_cnpj;
            $this->mei_nome = $mei->mei_nome;
            $this->mei_email = $mei->mei_email;
            $this->mei_telefone = $mei->mei_telefone;
            $this->mei_entregue = $mei->mei_entregue;
            $this->mei_cep = $mei->mei_cep;
            $this->mei_situacao = $mei->mei_situacao;
            $this->mei_status = $mei->mei_status;
            $this->mei_ano = $mei->mei_ano;
            $this->mei_endereco = $mei->mei_endereco;
            $this->mei_numero = $mei->mei_numero;
            $this->mei_complemento = $mei->mei_complemento;
            $this->mei_bairro = $mei->mei_bairro;
            $this->mei_cidade = $mei->mei_cidade;
            $this->mei_uf = $mei->mei_uf;
            $this->mei_cnae = $mei->mei_cnae;
            $this->mei_cnae_desc = $mei->mei_cnae_desc;
        }
    }

    
    public function save()
    {
        $validatedData = $this->validate();
        
        try {
            
            if ($this->isEdit) {
                $this->mei->update($validatedData);
                //$message = "Atualizado com sucesso.";
            } else {
                Mei::create($validatedData);
                //$message = "Cadastrado no sistema.";
            }
    
            //$this->setMensagemSucesso('Salvo com sucesso');
            //$this->emit('notification', 'success', $message);
            //$this->dispatchBrowserEvent('notification');
            //$this->emit('refreshComponent');
    
            $this->resetForm();
            $this->closeModal();
    
            return redirect()->to('/painel/lista-meis');
        } catch (\Exception $e) {
             return redirect()->route('error')->with('error', '405 - Comunique o adiministrador do sistema.' /*.$e->getMessage()*/);
        }
    }
    private function resetForm()
    {
        $this->reset([
            'mei_cnpj', 'mei_nome', 'mei_email', 'mei_telefone', 'mei_entregue', 'mei_cep',
            'mei_situacao', 'mei_status', 'mei_ano', 'mei_endereco', 'mei_numero',
            'mei_complemento', 'mei_bairro', 'mei_cidade', 'mei_uf', 'mei_cnae', 'mei_cnae_desc',
        ]);
    }

    public function render()
    {
        return view('livewire.panel.list-meis.mei-form');
    }
}
