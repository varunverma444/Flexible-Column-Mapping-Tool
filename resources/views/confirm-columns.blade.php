@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Confirm Column Matching</h2>

        <form method="POST" action="{{ route('save.data') }}">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <h4>CSV Columns:</h4>
                    <ul>
                        @foreach ($headerRow as $index => $column)
                            <li>{{ $column }}:
                                <select name="column_mapping[{{ $index }}]">
                                    <option value="">-- Select DB Column --</option>
                                    <option value="0">Column 1</option>
                                    <option value="1">Column 2</option>
                                    <option value="2">Column 3</option>
                                    <option value="3">Column 4</option>
                                    <option value="4">Column 5</option>
                                </select>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <h4>CSV Data:</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                @foreach ($headerRow as $column)
                                    <th>{{ $column }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    @foreach ($row as $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
				<input type="hidden" name="rows" value="{{ json_encode($rows) }}">
            </div>

            <button type="submit" class="btn btn-primary">Save Data</button>
        </form>
    </div>
@endsection
