<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
    <style>
        body { background: #0f172a; color: white; font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; }
        .form-box { background: #1e293b; padding: 30px; border-radius: 15px; width: 400px; border: 1px solid rgba(255,255,255,0.1); }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; background: #0f172a; border: 1px solid #334155; color: white; border-radius: 5px; }
        button { width: 100%; background: #6366f1; color: white; padding: 12px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #94a3b8; text-decoration: none; font-size: 13px; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Add New Task</h2>
        <form action="{{ route('cards.store') }}" method="POST">
            @csrf
            <input type="hidden" name="task_list_id" value="{{ $listId }}">
            
            <label>Task Title</label>
            <input type="text" name="title" required placeholder="Enter task name">
            
            <label>Description</label>
            <textarea name="description" rows="4" placeholder="Enter details"></textarea>
            
            <button type="submit">Save Task & Return</button>
            <a href="/" class="back-link">Cancel and Go Back</a>
        </form>
    </div>
</body>
</html>