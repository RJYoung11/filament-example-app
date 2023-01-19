<x-filament::page>
    <table class="border-collapse border border-slate-500" style="width: 100%">
        <thead>
            <tr>
                <th class="border border-slate-600">ID Nation</th>
                <th class="border border-slate-600">Nation</th>
                <th class="border border-slate-600">Year</th>
                <th class="border border-slate-600">Population</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td class="border border-slate-700">{{ $value['ID Nation'] }}</td>
                    <td class="border border-slate-700">{{ $value['Nation'] }}</td>
                    <td class="border border-slate-700">{{ $value['Year'] }}</td>
                    <td class="border border-slate-700">{{ number_format($value['Population'], 0, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament::page>
<style>
    th,
    td {
        padding: 10px;
    }
</style>
