<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contacts = Contact::select('*');
            return Datatables::of($contacts)
                ->addColumn('action', function ($contacts) {
                    $button = '
                        <a href="' . route('contacts.show', $contacts->id) . '" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="' . route('contacts.edit', $contacts->id) . '" class="btn btn-info"><i class="far fa-envelope"></i></a>              
                    <form action="' . route('contacts.delete', $contacts->id) . '" method="POST" class="delform">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                    </form>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Back.Contacts.contactsshow');
    }


    public function show($id)
    {
        $contact = Contact::find($id);

        return view('Back.Contacts.contactsview', [
            "contact" => $contact
        ]);
    }


    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('Back.Contacts.contactsedit', [
            "contact" => $contact
        ]);
    }


    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);

        Mail::to($contact->email)->send(new \App\Mail\ContactAnswer($request->answer, $contact->message));
        if ($contact->status == "Чекає відповіді")
            $contact->status = "Відповідь дано";

        $contact->save();
        return redirect()->route('contacts.view')->with('alert-success', 'Відповідь успішно надіслана користувачу на електронну пошту!');
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);

        $contact->delete();

        return redirect()->route('contacts.view')->with('alert-success', 'Звернення було успішно видалено з бази даних!');
    }
}
