<h1>Create Reservation</h1>

<form action="{{ route('reservations.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" required>

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date" required>

    <label for="image">Image:</label>
    <input type="file" name="image" id="image">

    <button type="submit">Submit</button>
</form>
