<tr>
    <th scope="row">{{ $billing->id }}</th>
    <td><a href="{{ route('billings.show', $billing) }}">{{ $billing->name }} »</a></td>
    <td>{{ $billing->working_days_rate }}</td>
    <td>{{ $billing->weekend_rate }}</td>
    <td>
        <span data-toggle="tooltip" data-placement="left" title="{{ $billing->created_at }}">
            {{ $billing->created_at->diffForHumans() }}
        </span>
    </td>
    <td>
        @if($billing->settlement)
            <div class="btn btn-sm btn-success btn-icon-split">
                <span class="text">{{ $billing->settlement }}</span>
                <span class="icon text-white-50">zł</span>
            </div>
        @elseif($billing->imported)
            <button class="btn btn-sm btn-primary btn-icon-split calculate-settlement"
                    data-billing_id="{{ $billing->id }}">
                <span class="icon text-white-50">
                    <i class="fas fa-calculator fa-sm text-white-50"></i>
                </span>
                <span class="text">Przelicz</span>
            </button>
        @else
            <button class="btn btn-sm btn-warning btn-icon-split"
                    data-toggle="tooltip" data-placement="left" title="Kliknij aby odświeżyć stronę i sprawdzić czy dane się już zaimportowały"
                    onclick="location.reload()">
                <span class="icon text-white-50">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </span>
                <span class="text">Importowanie...</span>
            </button>
        @endif
    </td>
    <td>
        <form method="POST" action="{{ route('billings.destroy', $billing) }}">
            @csrf
            @method('DELETE')
            <button type="submit"
                    onclick="return confirm('Czy na pewno chcesz usunąć ten biling?')"
                    class="btn btn-sm btn-danger">Usuń</button>
        </form>
    </td>
</tr>
