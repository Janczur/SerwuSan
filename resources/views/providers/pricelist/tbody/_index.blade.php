<tr>
    <th scope="row">{{ $providerPricelist->id }}</th>
    <td><a href="{{ route('providersPriceLists.show', $providerPricelist) }}">{{ $providerPricelist->name }} »</a></td>
    <td>
        <span data-toggle="tooltip" data-placement="left" title="{{ $providerPricelist->created_at }}">
            {{ $providerPricelist->created_at->diffForHumans() }}
        </span>
    </td>
    <td>
        <form method="POST" action="{{ route('providersPriceLists.destroy', $providerPricelist) }}">
            @csrf
            @method('DELETE')
            <button type="submit"
                    onclick="return confirm('Czy na pewno chcesz usunąć ten cennik?')"
                    class="btn btn-sm btn-danger">Usuń</button>
        </form>
    </td>
</tr>
