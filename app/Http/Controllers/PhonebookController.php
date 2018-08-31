<?php

namespace App\Http\Controllers;
use App\Http\Requests\PhonebookRequest;
use App\Phonebook;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{

    public function index()
    {
        return view('phonebook');
    }

    public function getData()
    {
	   return  Phonebook::orderBy('name','ASC')->get();
    }


    public function store(PhonebookRequest $request)
    {
	    $pb = new phoneBook;
	    $pb ->name = $request->name;
	    $pb ->phone = $request->phone;
	    $pb ->email = $request->email;
	    $pb ->save();

    }


    public function show(PhonebookRequest $phonebook)
    {

    }

    public function edit(PhonebookRequest $phonebook)
    {

    }

    public function update(PhonebookRequest $request)
    {
	    $pb = phoneBook::find($request->id);
	    $pb ->name = $request->name;
	    $pb ->phone = $request->phone;
	    $pb ->email = $request->email;
	    $pb ->save();
    }

    public function destroy(Phonebook $phonebook)
    {

    }
}
