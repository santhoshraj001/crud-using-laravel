<!DOCTYPE html>
<html>
<head>
    <title>Register Form</title>
</head>
<body>

<h1>Register form</h1>

<!-- ✅ SUCCESS MESSAGE -->
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<!-- ✅ SAME FORM : INSERT + UPDATE -->
<form method="POST"
      action="{{ isset($editData) ? route('student.update', $editData->id) : route('student.store')  }}">

    @csrf

    <!-- ✅ Hidden ID only for Edit -->
    @if(isset($editData))
    <input type="hidden" name="id" value="{{ $editData->id }}">
    @endif

    <!-- ✅ Hidden ID only for Edit -->
     
    <label>Name:</label>
    <input type="text" name="name" 
           value="{{ $editData->name ?? '' }}" required>
    <br><br>

    <label>Email:</label>
    <input type="email" name="email" 
           value="{{ $editData->email ?? '' }}" required>
    <br><br>

    <label>Contact:</label>
    <input type="number" name="contact" 
           value="{{ $editData->contact ?? '' }}" required>
    <br><br>

    <label>Place:</label>
    <select name="place" required>
        <option value="">Select</option>
        <option value="New York" {{ (isset($editData) && $editData->place=='New York') ? 'selected' : '' }}>New York</option>
        <option value="madurai" {{ (isset($editData) && $editData->place=='madurai') ? 'selected' : '' }}>Madurai</option>
        <option value="Chennai" {{ (isset($editData) && $editData->place=='Chennai') ? 'selected' : '' }}>Chennai</option>
        <option value="kumbakonam" {{ (isset($editData) && $editData->place=='kumbakonam') ? 'selected' : '' }}>Kumbakonam</option>
        <option value="villupuram" {{ (isset($editData) && $editData->place=='villupuram') ? 'selected' : '' }}>Villupuram</option>
    </select>
    <br><br>

    <label>Gender:</label>
    <input type="radio" name="gender" value="male"
           {{ (isset($editData) && $editData->gender=='male') ? 'checked' : '' }} required>
    Male

    <input type="radio" name="gender" value="female"
           {{ (isset($editData) && $editData->gender=='female') ? 'checked' : '' }} required>
    Female
    <br><br>
    <label>Qualification:</label>
    <input type="checkbox" name="qualification[]" value="10th" {{ (isset($editData) && in_array('10th', explode(',', $editData->qualification))) ? 'checked' : '' }}>10th
    <input type="checkbox" name="qualification[]" value="B.sc(cs)" {{ (isset($editData) && in_array('B.sc(cs)', explode(',', $editData->qualification))) ? 'checked' : '' }}>B.sc(cs)
    <input type="checkbox" name="qualification[]" value="M.sc(cs)" {{ (isset($editData) && in_array('M.sc(cs)', explode(',', $editData->qualification))) ? 'checked' : '' }}>M.sc(cs)
    <input type="checkbox" name="qualification[]" value="B.E(cs)" {{ (isset($editData) && in_array('B.E(cs)', explode(',', $editData->qualification))) ? 'checked' : '' }}>B.E(cs)
    <input type="checkbox" name="qualification[]" value="M.E(cs)" {{ (isset($editData) && in_array('M.E(cs)', explode(',', $editData->qualification))) ? 'checked' : '' }}>M.E(cs)
    <br><br>
    <button type="submit">
        {{ isset($editData) ? 'Update' : 'Submit' }}
    </button>

    <!-- Cancel edit Returns to normal insert mode using named route -->
    @if(isset($editData))
        <a href="{{ route('student.index')}}">Cancel</a> 
    @endif
</form>
<hr>
<form method="POST" action="{{ route('student.deleteselected') }}">
    @csrf
<button type="submit" formnovalidate>delete selected</button>
 


<h2>All Users</h2>

<table border="1">
    <tr>
        <th>select</th>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Place</th>
        <th>Gender</th>
        <th>Qualification</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

    @foreach($data as $row)
    <tr>
        <td>
    <input type="checkbox" name="ids[]" value="{{ $row->id }}">
</td>

        <td>{{ $row->id }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->email }}</td>
        <td>{{ $row->contact }}</td>
        <td>{{ $row->place }}</td>
        <td>{{ $row->gender }}</td>
        <td>{{ $row->qualification }}</td>
        <td>
       <a href="{{ route('student.index', ['edit' => $row->id]) }}">Edit</a>

            <!-- <a href="/example?edit={{ $row->id }}">Edit</a> -->
        </td>
        <td>
         <a href="{{ route('student.delete', $row->id) }}">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
</form>
</body>
</html>
