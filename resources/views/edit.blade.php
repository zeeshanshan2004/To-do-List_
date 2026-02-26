<!DOCTYPE html>
<html>
<head>
    <title>Edit Task - Project Maza</title>
    <link rel="stylesheet" href="{{ asset('assets/css/board.css') }}">
    <style>
        .edit-page-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }
        .edit-box {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            padding: 32px;
            border-radius: 20px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 800;
            color: var(--indigo);
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        input, textarea {
            width: 100%;
            background: var(--bg-color);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 14px;
            color: white;
            font-family: inherit;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: var(--indigo);
        }
        .btn-update {
            width: 100%;
            background: var(--indigo);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
        }
    </style>
</head>
<body>
    <div class="edit-page-container">
        <div class="edit-box">
            <h1>Edit Task</h1>
            
            <form action="{{ route('cards.update', $card->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Task Title</label>
                    <input type="text" name="title" value="{{ $card->title }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="5">{{ $card->description }}</textarea>
                </div>

                <button type="submit" class="btn-update">Save Changes</button>
                
                <a href="{{ route('board.index') }}" 
                   style="display: block; text-align: center; margin-top: 15px; color: var(--text-gray); text-decoration: none; font-size: 13px;">
                   ← Cancel
                </a>
            </form>
        </div>
    </div>
</body>
</html>