<tr>
    <th scope="row">{{ $billing->id }}</th>
    <td><a href="{{ route('billings.show', $billing) }}">{{ $billing->name }}</a></td>
    <td>{{ $billing->working_days_rate }}</td>
    <td>{{ $billing->weekend_rate }}</td>
    <td>{{ $billing->created_at }}</td>
    <td>
        @if($billing->settlement)
            <strong>{{ $billing->settlement }} zł</strong>
        @else
            <button class="btn btn-sm btn-primary calculate-settlement" data-billing_id="{{ $billing->id }}">
                <i class="fas fa-coins fa-sm text-white-50"></i> Przelicz
            </button>
        @endif
    </td>
    <td>
        <form method="POST" action="{{ route('billings.destroy', $billing) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Usuń</button>
        </form>
    </td>
</tr>
