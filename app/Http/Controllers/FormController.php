<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormQueue;

class FormController extends Controller
{
    public function edit($id) {
        $entry = FormQueue::findOrFail($id);
        return view('queue.edit', compact('entry'));
    }
    
    public function update(Request $request, $id) {
        $entry = FormQueue::findOrFail($id);
        $entry->update($request->only(['name', 'status']));
        return redirect()->route('queue.display')->with('success', 'Queue entry updated!');
    }
    
    public function showQueue() {
        $queueEntries = FormQueue::where('status', '!=', 'done')->get();
        return view('queue_display', compact('queueEntries'));
    }
    
    public function destroy($id) {
        FormQueue::findOrFail($id)->delete();
        return redirect()->route('queue.list')->with('success', 'Entry deleted successfully!');
    }
    
    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:waiting,e-registration,oec,information_sheet,welfare_registration_and_division,direct_hire,SENA,done',
    ]);

    $entry = FormQueue::findOrFail($id);
    $entry->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Status updated successfully!');
}


    // Show the form page
    public function showForm()
    {
        return view('form'); // Ensure this matches the Blade template name
    }

    // Handle form submission
    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'purpose' => 'required|array|min:1|max:6', // Ensures at least 1, up to 6 selected
            'purpose.*' => 'in:e-registration,oec,information_sheet,welfare_registration_and_division,direct_hire,SENA',
        ]);        

        FormQueue::create([
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'purpose' => $request->input('purpose'),
            'status' => 'waiting',
            'completed' => false,
        ]);

        return back()->with('success', 'Form submitted successfully! Selected purposes: ' . implode(', ', $request->input('purpose')));
    }
        public function viewQueue()
    {
        $queueEntries = FormQueue::where('status', '!=', 'done')->get(); // Fetch all except 'done'
        
        return view('queue', compact('queueEntries'));
    }

}
