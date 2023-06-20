@extends('layouts.app')

@section('content')
<script>
    function confirmDelete() {
        var password1 = document.getElementById('password1').value;
        var password2 = document.getElementById('password2').value;

        if (password1 === '' || password2 === '') {
            alert('Lūdzu ievadiet savu paroli abos laukos.');
            return false;
        }

        if (password1 !== password2) {
            alert('Paroles nesakrīt. Mēģiniet vēlreiz.');
            return false;
        }

        // Show a confirmation dialog
        var result = confirm('Vai tiešām vēlaties dzēst profilu un visus saistītos datus? Šis process ir neatgriezenisks.');

        if (result) {
            // If the user confirms, submit the form
            document.getElementById('delete-form').submit();
        }
    }
</script>
<div class="container">
<!-- Warning message -->
<div class="alert alert-warning">
    <p><strong>Brīdinājums:</strong> Jūsu profils tik neatgriezeniski izdzēsts līdz ar visām Jūsu receptēm.</p>
    <p>Lūdzu ievadiet Jūsu paroli, lai apstiprinātu konta izdzēšanu.</p>
</div>

<!-- Form for deletion confirmation -->

<div>
<form id="delete-form" action="{{ route('profile.delete') }}" method="POST">
    @csrf
    <!-- Add your password input fields and any other required inputs here -->
    <div class="form-group">
        <label for="password1">Parole:</label>
        <input type="password" id="password1" name="password1" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="password2">Apstiprināt paroli:</label>
        <input type="password" id="password2" name="password2" class="form-control" required>
    </div>

    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Dzēst profilu</button>
</form>
</div>
</div>
@endsection
