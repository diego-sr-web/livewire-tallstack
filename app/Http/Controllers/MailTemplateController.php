<?php

namespace App\Http\Controllers;

use App\Models\MailMarketingTemplates\MailMarketingTemplate;
use App\Models\MailTransactionalTemplates\MailTransactionalTemplate;
use Illuminate\Http\Request;

class MailTemplateController extends Controller
{
    public function marketingIndex()
    {
        return view('livewire.mail-marketing.index');
    }

    public function marketingCreate()
    {
        return view('livewire.mail-marketing.create');
    }

    public function marketingStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'status' => 'boolean',
                'title' => 'required|string',
                'preheader' => 'required|string',
                'subject' => 'required|string',
                'body' => 'required|string',
            ]);

            $validatedData ['company_id'] = companyId();
            $validatedData ['user_id'] = user()->id;

            MailMarketingTemplate::create($validatedData);

            return redirect()->route('mail-marketing.index');
        } catch (\Exception $e) {
            return redirect()->route('error')->with('error.error', $e->getMessage());
        }
    }

    public function marketingEdit($id)
    {
        try {
            $mailTemplate = MailMarketingTemplate::find($id);

            if (!$mailTemplate) {
                return abort(404);
            }

            return view('livewire.mail-marketing.edit', [
                'mailTemplate' => $mailTemplate
            ]);
        } catch (\Exception $e) {
            return redirect()->route('error')->with('error.error', $e->getMessage());
        }
    }

    public function marketingUpdate(Request $request, $id)
    {
        try {   
            $mailTemplate = MailMarketingTemplate::find($id);

            if (!$mailTemplate) {
                return abort(404);
            }

            $validatedData = $request->validate([
                'name' => 'required|string',
                'status' => 'boolean',
                'title' => 'required|string',
                'preheader' => 'required|string',
                'subject' => 'required|string',
                'body' => 'required|string',
            ]);

            $mailTemplate->update($validatedData);

            return redirect()->route('mail-marketing.index');
        } catch (\Exception $e) {
            return redirect()->route('error')->with('error.error', $e->getMessage());
        }
    }



    public function transactionalIndex()
    {
        return view('livewire.mail-transactional.index');
    }

    public function transactionalCreate()
    {
        return view('livewire.mail-transactional.create');
    }

    public function transactionalStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'status' => 'boolean',
                'title' => 'required|string',
                'preheader' => 'required|string',
                'subject' => 'required|string',
                'body' => 'required|string',
            ]);

            $validatedData ['company_id'] = companyId();
            $validatedData ['user_id'] = user()->id;

            $mailTemplate = MailTransactionalTemplate::create($validatedData);

            return redirect()->route('mail-transactional.index');
        } catch (\Exception $e) {
            return redirect()->route('error')->with('error.error', $e->getMessage());
        }
    }

    public function transactionalEdit($id)
    {
        try {
            $mailTemplate = MailTransactionalTemplate::find($id);

            if (!$mailTemplate) {
                return abort(404);
            }

            return view('livewire.mail-transactional.edit', [
                'mailTemplate' => $mailTemplate
            ]);
        } catch (\Exception $e) {
            return redirect()->route('error')->with('error.error', $e->getMessage());
        }
    }

    public function transactionalUpdate(Request $request, $id)
    {
        try {
            $mailTemplate = MailTransactionalTemplate::find($id);

            if (!$mailTemplate) {
                return abort(404);
            }

            $validatedData = $request->validate([
                'name' => 'required|string',
                'status' => 'boolean',
                'title' => 'required|string',
                'preheader' => 'required|string',
                'subject' => 'required|string',
                'body' => 'required|string',
            ]);

            $mailTemplate->update($validatedData);

            return redirect()->route('mail-transactional.index');
        } catch (\Exception $e) {
            return redirect()->route('error')->with('error.error', $e->getMessage());
        }
    }
}
