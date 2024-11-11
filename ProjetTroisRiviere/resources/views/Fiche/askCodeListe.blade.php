@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<form action="{{ route('askCodeListe') }}" method="GET">
    @csrf
    <div>
        <label for="codeListe">Entrez le code de la liste :</label>
        <input type="text" id="codeListe" name="codeListe" required>
    </div>
    <button type="submit">Soumettre</button>
</form>