<form method="post" action="{{ route('storeCalendar') }}" class="row">
    @csrf
    <div class="col-md-2 mt-2">
        <label>Tytuł wydarzenia</label>
        <input type="text" name="title" class="form-control">
        @error('title')
        <span class="flash-message__alert" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-3 mt-2">
        <label>Opis wydarzenia</label>
        <input type="text" name="description" class="form-control">
        @error('description')
        <span class="flash-message__alert" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-1 mt-2">
        <label>Kolor</label>
        <select name="color" class="form-control">
            @foreach(app('CalendarColorEnum')->getAllColors() as $id => $color)
                <option value="{{ $id }}" style="background-color: {{ $color }};">&nbsp;</option>
            @endforeach
        </select>
        @error('color')
        <span class="flash-message__alert" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-2 mt-2">
        <label>Data początku</label>
        <input type="datetime-local" name="date_start" class="form-control">
        @error('date_start')
        <span class="flash-message__alert" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-2 mt-2">
        <label>Data końca</label>
        <input type="datetime-local" name="date_end" class="form-control">
        @error('date_end')
        <span class="flash-message__alert" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-2 mt-4 text-center">
        <button type="submit" class="btn-primary btn">Dodaj wydarzenie</button>
    </div>
</form>
