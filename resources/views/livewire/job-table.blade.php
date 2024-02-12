<div>
    {{-- Table --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Worker</th>
                <!-- Add other columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->id }}</td>
                    <td>{{ $job->client->name }}</td>
                    <td>{{ $job->worker->name }}</td>
                    <!-- Add other columns as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

