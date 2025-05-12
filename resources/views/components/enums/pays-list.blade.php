<select name="pays" class="form-select" required>
    @foreach ($pays as $pay)
        <option value="{{ $pay->id }}" {{  }}>{{ $pay->name }}</option>
    @endforeach
</select>


