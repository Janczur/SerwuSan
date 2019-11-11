<tr>
    <th scope="row">{{ $billing->id }}</th>
    <td><a href="{{ route('billings.show', $billing) }}">{{ $billing->name }}</a></td>
    <td>{{ $billing->working_days_rate }}</td>
    <td>{{ $billing->saturday_rate }}</td>
    <td>{{ $billing->created_at }}</td>
    <td>
        <form method="POST" action="{{ route('billings.destroy', $billing) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Usuń</button>
        </form>
    </td>
</tr>
