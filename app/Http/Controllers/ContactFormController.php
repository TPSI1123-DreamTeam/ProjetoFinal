<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{

    public function contact()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {

        $messages = [
            'name.required' => 'Precisamos de saber o seu nome!',
            'email.required' => 'Não se esqueça do seu email!',
            'email.email' => 'Por favor introduza um email válido.',
            'message.required' => 'Uma mensagem é necessária para submeter o formulário.',
        ];

        // Capture and validate the data

        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ], $messages);

        // Process the data (e.g., validation, sending email)

        Mail::to('Vasco.Sousa.T0127548@edu.atec.pt')->send(new ContactMail($validatedData));
        // Here you will handle the form submission, like validating input and sending emails.
        return back()->with('success', 'Obrigado pela sua mensagem!');
    }
}
