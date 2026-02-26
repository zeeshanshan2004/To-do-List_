<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\Card;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    // 1. Main Board dikhane ke liye
    public function index()
    {
        $lists = TaskList::with('cards')->orderBy('position', 'asc')->get();
        return view('board', compact('lists'));
    }

    // 2. Naya page (Form) dikhane ke liye
    public function create($listId) 
    {
        // Hum listId bhej rahe hain takay form ko pata ho task kis column ka hai
        return view('create_card', compact('listId'));
    }

    // 3. Task ko database mein save karne ke liye
    public function store(Request $request) 
    {
        // Validation lazmi hai takay khali task save na ho
        $request->validate([
            'title' => 'required|max:255',
            'task_list_id' => 'required|exists:task_lists,id',
        ]);

        Card::create([
            'title' => $request->title,
            'description' => $request->description,
            'task_list_id' => $request->task_list_id,
            'position' => 0 // Filhal default 0
        ]);

        // Save karne ke baad wapis board (index) par bhej do
        return redirect('/')->with('success', 'Maza agaya! Task add ho gaya.'); 
    }
public function move(Request $request, $id)
{
    $card = Card::findOrFail($id);
    // Button se aane wali value (In Progress ya Done) ke mutabiq list dhoondein
    $targetList = TaskList::where('title', $request->target)->first();

    if ($targetList) {
        $card->task_list_id = $targetList->id;
        $card->save();
    }

    return back();
}
// Delete Task
public function destroy($id) {
    Card::findOrFail($id)->delete();
    return back()->with('success', 'Task deleted!');
}

// Edit Page
public function edit($id) {
    $card = Card::findOrFail($id);
    return view('edit', compact('card'));
}

// Update Task
public function update(Request $request, $id) {
    $card = Card::findOrFail($id);
    $card->update($request->only(['title', 'description']));
    return redirect('/')->with('success', 'Task updated!');
}
}