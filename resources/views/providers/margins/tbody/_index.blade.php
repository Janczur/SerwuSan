<tr>
    <td></td>
    <td hidden>{{ $providerMargin->id }}</td>
    <td>
        <span class="apply-xeditable"
              data-pk="{{ $providerMargin->id }}"
              data-url="{{ route('providersMargins.editable.update.country', ['providerMargin' => $providerMargin->id]) }}">
            {{ $providerMargin->country }}
        </span>
    </td>
    <td>
        <span class="apply-xeditable"
              data-pk="{{ $providerMargin->id }}"
              data-url="{{ route('providersMargins.editable.update.margin', ['providerMargin' => $providerMargin->id]) }}">
            {{ $providerMargin->margin }}
        </span>
    </td>
</tr>
