<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Maza - Board</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: #1e293b;
            --column-bg: rgba(255, 255, 255, 0.05);
            --border-color: rgba(255, 255, 255, 0.1);
            --indigo: #6366f1;
            --text-white: #ffffff;
            --text-gray: #94a3b8;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-white);
            font-family: 'Inter', sans-serif;
            padding: 40px;
            margin: 0;
        }

        h1 {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(to right, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
        }

        .board {
            display: flex;
            gap: 24px;
            overflow-x: auto;
            align-items: flex-start;
        }

        .column {
            background: var(--column-bg);
            border: 1px solid var(--border-color);
            width: 320px;
            padding: 20px;
            border-radius: 16px;
            flex-shrink: 0;
        }

        .column h3 {
            margin-top: 0;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #a5b4fc;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            padding: 16px;
            margin-bottom: 16px;
            border-radius: 12px;
            border-left: 4px solid var(--indigo);
        }

        .desc {
            font-size: 13px;
            color: var(--text-gray);
            margin: 10px 0;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .move-btns {
            display: flex;
            gap: 6px;
        }

        .move-btn {
            border: none;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
            text-transform: uppercase;
            transition: 0.2s;
        }

        .move-btn:hover {
            transform: scale(1.05);
            filter: brightness(1.2);
        }

        .action-icons {
            display: flex;
            gap: 12px;
        }

        .icon-link, .delete-btn {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 14px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .icon-link:hover { color: var(--indigo); }
        .delete-btn:hover { color: #ef4444; }

        .add-task-btn {
            display: block;
            text-align: center;
            text-decoration: none;
            background: rgba(99, 102, 241, 0.1);
            color: var(--indigo);
            padding: 12px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
            border: 1px dashed var(--indigo);
            transition: 0.3s;
        }

        .add-task-btn:hover {
            background: var(--indigo);
            color: white;
            border-style: solid;
        }
    </style>
</head>
<body>

    <h1>Project To-do List</h1>

    <div class="board">
        @foreach($lists as $list)
            <div class="column">
                <h3>{{ $list->title }}</h3>

                <div class="cards">
                    @foreach($list->cards as $card)
                        <div class="card">
                            <div style="font-weight: bold;">{{ $card->title }}</div>
                            
                            @if($card->description)
                                <p class="desc">{{ $card->description }}</p>
                            @endif

                           <div class="card-footer" style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px; padding-top: 10px; border-top: 1px solid rgba(255,255,255,0.1);">
    
    <div class="move-btns">
        <form action="{{ route('cards.move', $card->id) }}" method="POST" style="margin: 0;">
            @csrf
            {{-- Check exact matching with your screenshot titles --}}
            @if($list->title == 'To-Do')
                <button name="target" value="In Progress" class="move-btn" style="background: #fbbf24; color: black; border: none; padding: 5px 10px; border-radius: 6px; font-size: 10px; font-weight: 800; cursor: pointer; text-transform: uppercase;">
                    Progress
                </button>
            @elseif($list->title == 'In Progress')
                <button name="target" value="Done" class="move-btn" style="background: #22c55e; color: white; border: none; padding: 5px 10px; border-radius: 6px; font-size: 10px; font-weight: 800; cursor: pointer; text-transform: uppercase;">
                    Done
                </button>
            @endif
        </form>
    </div>

    <div class="action-icons" style="display: flex; gap: 10px;">
        <a href="{{ route('cards.edit', $card->id) }}" style="color: #94a3b8; text-decoration: none; font-size: 14px;" title="Edit">
            <i class="fas fa-pen"></i>
        </a>
        
        <form action="{{ route('cards.destroy', $card->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Pakka delete karna hai?')">
            @csrf
            @method('DELETE')
            <button type="submit" style="background: none; border: none; color: #94a3b8; cursor: pointer; padding: 0; font-size: 14px;" title="Delete">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </div>
</div>
                        </div>
                    @endforeach
                </div>
                
                <a href="{{ route('cards.create', $list->id) }}" class="add-task-btn">+ Add New Task</a>
            </div>
        @endforeach
    </div>

</body>
</html>