<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CustomerDetail;
use App\Http\Controllers\Controller;

class AdminCustomerController extends Controller
{
    public function contactUs()
    {
        menuSubmenu('contactUs','custommer_message');
        
        $customersMessage = CustomerDetail::latest()->paginate(20);
        return view('admin.customer.contactUs', compact('customersMessage'));
    }

    public function destroy($id)
    {
        CustomerDetail::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Message deleted successfully');
    }
}
