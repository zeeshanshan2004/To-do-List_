<!DOCTYPE html>
<html>
<head>
    <title>Project To-do List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 <link rel="stylesheet" href="{{ asset('css/board.css') }}">
</head>
<body>
    <div class="board">
        @foreach($lists as $list)
            <div class="column">
                <h3 style="color: #a5b4fc;">{{ $list->title }}</h3>
                <div class="cards">
                    @foreach($list->cards as $card)
                        <div class="card">
                            <div style="font-weight: bold;">{{ $card->title }}</div>
                            @if($card->description)
                                <p style="font-size: 12px; color: #94a3b8;">{{ $card->description }}</p>
                            @endif

                            <div class="card-actions">
                                <div style="display: flex; gap: 5px;">
                                    <form action="{{ route('cards.move', $card->id) }}" method="POST">
                                        @csrf
                                        @if($list->title == 'TO-DO')
                                            <button name="target" value="IN PROGRESS" class="btn-move" style="background: #fbbf24;">IN PROGRESS</button>
                                            <button name="target" value="DONE" class="btn-move" style="background: #22c55e; color:white;">DONE</button>
                                        @elseif($list->title == 'IN PROGRESS')
                                            <button name="target" value="DONE" class="btn-move" style="background: #22c55e; color:white;">DONE</button>
                                        @endif
                                    </form>
                                </div>

                                <div style="display: flex; gap: 10px;">
                                    <a href="{{ route('cards.edit', $card->id) }}" class="icon-btn"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('cards.destroy', $card->id) }}" method="POST" onsubmit="return confirm('Delete kar dain?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="icon-btn delete-btn"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('cards.create', $list->id) }}" class="add-btn">+ Add New Task</a>
            </div>
        @endforeach
    </div>
</body>
</html>