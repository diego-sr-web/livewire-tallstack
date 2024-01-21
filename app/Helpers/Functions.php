<?php

use App\Models\Collaborators\Collaborator;
use App\Models\Companies\Company;
use App\Models\Owners\Owner;
use App\Models\Users\User;
use Illuminate\Support\Carbon;

function isOwner()
{
    return user()->profile->relation::class == Owner::class;
}

function parameterToRoute($parameter)
{
    $data = [
        'maquinas' => 'machines',
        'maquina' => 'machine',
    ];

    if (array_key_exists($parameter, $data)) {
        return $data[$parameter];
    }

    abort(404);
}

function breadCrumbExists($index)
{
    if ((int)request()->segment($index) == 0) {
        return request()->segment($index);        
    }
    
    return null;
}

function getBreadCrumb($index, $type)
{
    $segment = breadCrumbExists($index);

    $breadCrumbs = [
        'admin' => ['route' => 'dashboards.index', 'label' => 'Admin'],
        'dashboard' => ['route' => 'dashboards.index', 'label' => 'Dashboard Administrativo'],
        'colaboradores' => ['route' => 'collaborators', 'label' => 'Colaboradores'],
        'papeis' => ['route' => 'roles', 'label' => 'Papeis de Acessos'],
        'perfil-permissoes' => ['route' => 'role-permissions', 'label' => 'ACL - Papel / Permissões'],
        'painel' => ['route' => 'machines', 'label' => 'Painel'],
        'maquinas' => ['route' => 'machines', 'label' => 'Maquinas'],
        'maquina' => ['route' => 'machines', 'label' => 'Maquina'],
        'perfil' => ['route' => 'profile.edit', 'label' => 'Perfil'],
        'permissoes' => ['route' => null, 'label' => 'Permissões'],
        'configuracoes' => ['route' => null, 'label' => 'Configurações'],
        'empresas' => ['route' => null, 'label' => 'Empresas'],
        'empresas' => ['route' => null, 'label' => 'Empresas'],
        'sequencias' => ['route' => null, 'label' => 'Sequências'],
        'uploads' => ['route' => null, 'label' => 'Uploads'],
        'mail-templates' => ['route' => null, 'label' => 'Email-Templates'],
        'mail-marketing' => ['route' => null, 'label' => 'Email-Marketing'],
        'mail-transactional' => ['route' => null, 'label' => 'Email-Transactional'],
        'cadastrar' => ['route' => 'mail-marketing.create', 'label' => 'Cadastrar'],
        'lista-meis' => ['route' => null, 'label' => 'Tabela-meis'],
        'arquivos' => ['route' => null, 'label' => 'Arquivos'],

    ];

    return data_get($breadCrumbs, $segment.'.'.$type);
}

function parseDateBr($date, $his = false)
{
    if ($his) {
        return Carbon::parse($date)->format('d/m/Y H:i:s');
    }

    return Carbon::parse($date)->format('d/m/Y H:i');
}

function getDateOrNow($date, $format = 'd/m/Y')
{
    return $date ?? now()->format($format);
}

function cleanPhoneField($phone)
{
    $phone = str_replace('(', '', $phone);
    $phone = str_replace(')', '', $phone);
    $phone = str_replace(' ', '', $phone);
    $phone = str_replace('-', '', $phone);
    $phone = str_replace('.', '', $phone);

    return $phone;
}

function formatManualValue($value)
{
    if (strlen($value) == 4) {
        $a = substr($value, 0, 2);
        $b = substr($value, 2, 4);

        return (float) $a.'.'.$b;
    }

    if (strlen($value) == 5) {
        $a = substr($value, 0, 3);
        $b = substr($value, 3, 5);

        return (float) $a.'.'.$b;
    }
}

function numberFormaterForDb($value)
{
    return str_replace(['.', ','], ['', '.'], $value);
}

/** @var User $user */
function user()
{
    return auth()->user();
}

function companyId($request = [])
{
    if (data_get($request, 'company_id')) {
        return data_get($request, 'company_id');
    }

    if (user()->profile->rel_type == Collaborator::class) {
        return user()->profile->relation->company->id;
    }

    if (user()->profile->rel_type == Company::class) {
        return user()->profile->relation->id;
    }

    return null;
}

function company($request = [])
{
    if (data_get($request, 'company_id')) {
        return Company::find(data_get($request, 'company_id'));
    }

    if (user()->profile->rel_type == Collaborator::class) {
        return user()->profile->relation->company;
    }

    if (user()->profile->rel_type == Company::class) {
        return user()->profile->relation;
    }

    return null;
}

function collaboratorId()
{
    if (user()->profile->rel_type == Collaborator::class) {
        return user()->profile->relation->id;
    }

    return null;
}

function collaborator()
{
    if (user()->profile->rel_type == Collaborator::class) {
        return user()->profile->relation;
    }

    return null;
}

function machineLogActionLabels($match = null, $labelLog = 'Máquina')
{
    $labels = [
        'C' => 'Criou', // Form
        'U' => 'Atualizou', // Update
        'D' => 'Excluiu', // Delete
        'S' => 'Iniciou '.$labelLog, // Start
        'P' => 'Pausou '.$labelLog, // Pause
    ];

    if ($match) {
        return $labels[$match];
    }

    return $labels;
}

function machineLogChanges($log, $labelLog='Maquina', $data = null)
{
    $status = data_get($log, 'status') ? $labelLog.' Iniciada' : $labelLog.' Parada';

    $data .= '<div>'.$status.'</div>';
    $data .= '<div>'.data_get($log, 'name').'</div>';
    
    if (data_get($log, 'description')) {
        $data .= '<div>'.data_get($log, 'description').'</div>';
    }
    
    if (data_get($log, 'active')) {
        $active = data_get($log, 'status') ? $labelLog.' Ativo' : $labelLog.' Inativo';
    
        $data .= '<div>'.$active.'</div>';
    }

    return $data;
}

function formatCnpjCpf($name, $value)
{
    if (in_array($name, ['cpf', 'cnpj'])) {
        $CPF_LENGTH = 11;
        $cnpjCpf = preg_replace("/\D/", '', $value);

        if (strlen($cnpjCpf) === $CPF_LENGTH) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", '$1.$2.$3-$4', $cnpjCpf);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", '$1.$2.$3/$4-$5', $cnpjCpf);
    }

    return $value;
}

function cleanCnpjCpf($name, $value)
{
    if (in_array($name, ['cpf', 'cnpj'])) {
        return str_replace(['.', '-', '/'], '', $value);
    }

    return $value;
}

function formatPhone($name, $phone)
{
    if (in_array($name, ['phone', 'phone_aditional'])) {
        $formatedPhone = preg_replace('/[^0-9]/', '', $phone);
        $matches = [];

        preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $formatedPhone, $matches);

        if ($matches) {
            return '('.$matches[1].') '.$matches[2].'-'.$matches[3];
        }
    }

    return $phone;
}

function cleanPhone($name, $phone)
{
    if (in_array($name, ['phone', 'phone_aditional'])) {
        return str_replace(['(', ')', '-', ' '], '', $phone);
    }

    return $phone;
}

function companyStatus($status = null)
{
    $data = [
        '0' => 'Empresa Inativa',
        '1' => 'Empresa Ativa',
        '2' => 'Empresa Bloqueada',
    ];

    if (array_key_exists($status, $data)) {
        return $data[$status];
    }

    return $data;
}

function sequenceStatus($status = null)
{
    $data = [
        '0' => 'Parado',
        '1' => 'Rodando',
        '2' => 'Finalizado',
    ];

    if (array_key_exists($status, $data)) {
        return $data[$status];
    }

    return $data;
}

function stepStatus($status = null)
{
    $data = [
        '0' => 'Parado',
        '1' => 'Rodando',
        '2' => 'Finalizado',
    ];

    if (array_key_exists($status, $data)) {
        return $data[$status];
    }

    return $data;
}

function CollaboratorStatus($status = null, $list = true)
{
    $data = [
        '0' => 'Inativo',
        '1' => 'Ativo',
        '2' => 'Outro motívo',
    ];

    if (array_key_exists($status, $data)) {
        return $data[$status];
    }

    if ($list) {
        return $data;
    } else {
        return false;
    }
}

function getErrorLabelTypeNotification($type)
{
    $types = [
        'error' => 'Erro !!!',
        'success' => 'Sucesso !!!',
        'warning' => 'Atenção !!!',
    ];

    return $types[$type];
}