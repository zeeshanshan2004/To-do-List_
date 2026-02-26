<!DOCTYPE html>
<html>
<head>
    <title>Project Maza - Drag & Drop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/board.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <style>
        /* Dragging ke waat card kaisa dikhega */
        .sortable-ghost {
            opacity: 0.4;
            border: 2px dashed #6366f1 !important;
        }
        .cards { min-height: 50px; } /* Khali column mein drop karne ke liye */
    </style>
</head>
<body>
    <h1>Project To-do List</h1>

    <div class="board">
        @foreach($lists as $list)
            <div class="column" data-list-id="{{ $list->id }}">
                <h3>{{ $list->title }}</h3>

                <div class="cards" id="list-{{ $list->id }}">
                    @foreach($list->cards as $card)
                        <div class="card" data-card-id="{{ $card->id }}">
                            <div style="font-weight: bold;">{{ $card->title }}</div>
                            @if($card->description)
                                <p class="desc">{{ $card->description }}</p>
                            @endif

                            <div class="card-footer">
                                <div class="action-icons">
                                    <a href="{{ route('cards.edit', $card->id) }}" class="icon-link"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('cards.destroy', $card->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="delete-btn"><i class="fas fa-trash"></i></button>
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

    <script>
        // 2. JavaScript Logic
        document.querySelectorAll('.cards').forEach(column => {
            new Sortable(column, {
                group: 'shared', // Cards ek column se dusre mein ja saken
                animation: 150,
                ghostClass: 'sortable-ghost',
                
                // Jab card drop ho jaye
                onEnd: function (evt) {
                    let cardId = evt.item.getAttribute('data-card-id');
                    let newListId = evt.to.parentElement.getAttribute('data-list-id');

                    // 3. Background mein Controller ko batana (AJAX)
                    axios.post('/cards/reorder', {
                        card_id: cardId,
                        list_id: newListId
                    })
                    .then(response => {
                        console.log('Saved successfully!');
                    })
                    .catch(error => {
                        alert('Something went wrong!');
                    });
                }
            });
        });
    </script>
</body>
</html>