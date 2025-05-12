<select name="transaction_type" class="form-select">
    <option value="Crédit">Crédit</option>
    <option value="Débit">Débit</option>
</select>
{{-- <select name="transaction_type" class="form-select">
    @foreach (\App\Enums\TransactionType::options() as $option)
        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
    @endforeach
</select> --}}
