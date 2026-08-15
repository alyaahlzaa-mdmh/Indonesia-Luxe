<x-layouts.site :title="'Monthly Report'">
    <h1 class="text-2xl font-semibold mb-4">Laporan Bulanan Admin</h1>

    <div class="rounded border bg-white p-4 space-y-2 text-sm">
        <p>Month: {{ $report['month'] }}</p>
        <p>Total Transactions: {{ $report['total_transactions'] }}</p>
        <p>Confirmed Transactions: {{ $report['confirmed_count'] }}</p>
        <p>Total Revenue: Rp {{ number_format($report['total_revenue'], 0, ',', '.') }}</p>
    </div>
</x-layouts.site>
