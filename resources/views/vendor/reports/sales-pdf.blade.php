<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Penjualan Vendor</title>
  <style>
    @page {
      margin: 0;
    }

    body {
      font-family: 'Helvetica', 'Arial', sans-serif;
      color: #1f2937;
      margin: 0;
      padding: 0;
    }

    /* Header */
    header {
      background-color: #121212;
      color: white;
      padding: 2.5rem 3rem;
      display: flex;
      justify-content: space-between;
      align-items: end;
    }

    .logo-section {
      display: flex;
      align-items: center;
      gap: 2rem;
    }

    .logo-section img {
      position: absolute;
      top: 1rem;
      left: 1.5rem;
    }

    .logo-section h1 {
      color: #b8860b;
      margin: 0 0 0 5rem;
      font-size: 24px;
      letter-spacing: 0.05em;
    }

    .logo-section p {
      color: #9ca3af;
      font-size: 11px;
      margin: 5px 0 0 5rem;
    }

    .report-label {
      text-align: right;
      position: absolute;
      top: 2.5rem;
      right: 3rem;
    }

    .report-label h2 {
      margin: 0;
      font-size: 14px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .report-label p {
      font-size: 11px;
      color: #9ca3af;
      margin-top: 5px;
    }

    /* Main Content */
    .content {
      padding: 3rem;
    }

    .vendor-title {
      margin-bottom: 2rem;
    }

    .vendor-title h2 {
      margin: 0;
      font-size: 28px;
      color: #111827;
    }

    .vendor-title p {
      margin-top: 8px;
      font-size: 13px;
      color: #6b7280;
    }

    /* Stats Cards */
    .stats-row {
      display: flex;
      gap: 12px;
      margin-bottom: 1.5rem;
      border-top: 1px solid #d4af37;
      padding-top: 20px;
    }

    .stat-card {
      flex: 1;
      background: #fff;
      border: 1px solid #dbc7a1;
      border-radius: 12px;
      padding: 18px;
      text-align: center;
      background-color: #fdfaf3;
    }

    .stat-card .label {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 0.025em;
      color: #6b7280;
      margin-bottom: 12px;
    }

    .stat-card .value {
      font-size: 16px;
      font-weight: bold;
      color: #111827;
    }

    /* Table */
    .details-header {
      font-size: 14px;
      font-weight: bold;
      margin: 2rem 0 1rem;
      color: #111827;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 11px;
    }

    th {
      background-color: #121212;
      color: white;
      text-align: left;
      padding: 10px 15px;
      text-transform: uppercase;
      font-weight: bold;
      letter-spacing: 0.05em;
    }

    td {
      padding: 12px 15px;
      border-bottom: 1px solid #f3f4f6;
      color: #374151;
    }

    .status-badge {
      font-size: 10px;
      color: #6b7280;
    }

    .revenue-value {
      color: #b8860b;
      font-weight: bold;
    }

    /* Footer */
    footer {
      margin-top: 4rem;
      text-align: center;
      padding-bottom: 3rem;
    }

    footer p {
      color: #9ca3af;
      font-size: 10px;
      margin: 4px 0;
    }

    .table-container {
      border: 1px solid #f3f4f6;
      border-radius: 12px;
      overflow: hidden;
    }
  </style>
</head>

<body>
  <header>
    <div class="logo-section">
      <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="width: 100px; height: auto;">
      <h1>INDONESIA LUXE</h1>
      <p>Premium Travel Marketplace</p>
    </div>
    <div class="report-label">
      <h2>LAPORAN VENDOR</h2>
      <p>Dicetak: {{ now()->translatedFormat('d F Y') }}</p>
    </div>
  </header>

  <div class="content">
    <div class="vendor-title">
      <h2>{{ auth()->user()->name }}</h2>
      <p>Laporan Keuangan & Transaksi · Indonesia Luxe Travel</p>
    </div>

    <table style="width: 100%; border-collapse: separate; border-spacing: 12px 0; margin: 0 -12px 1.5rem; border-top: 1.5px solid #d4af37; padding-top: 20px;">
      <tr>
        <td class="stat-card" style="width: 20%;">
          <div class="label">Total Pendapatan</div>
          <div class="value">Rp {{ number_format($report->total_revenue, 0, ',', '.') }}</div>
        </td>
        <td class="stat-card" style="width: 20%;">
          <div class="label">Total Transaksi</div>
          <div class="value">{{ $report->total_transactions }}</div>
        </td>
        <td class="stat-card" style="width: 20%;">
          <div class="label">Confirmed</div>
          <div class="value">{{ $report->confirmed_count }}</div>
        </td>
        <td class="stat-card" style="width: 20%;">
          <div class="label">Pending</div>
          <div class="value">{{ $report->pending_count }}</div>
        </td>
        <td class="stat-card" style="width: 20%;">
          <div class="label">Conversion Rate</div>
          <div class="value">{{ number_format($report->conversion_rate, 0) }}%</div>
        </td>
      </tr>
    </table>

    <div class="details-header">Detail Transaksi</div>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Customer</th>
            <th>Tour</th>
            <th>Peserta</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($report->items as $item)
          <tr>
            <td style="white-space: nowrap;">{{ $item->order->created_at->format('d/m/Y') }}</td>
            <td>{{ $item->order->user->name }}</td>
            <td>{{ $item->package_title }}</td>
            <td style="text-align: center;">{{ $item->quantity }}</td>
            <td class="revenue-value">Rp {{ number_format($item->line_total, 0, ',', '.') }}</td>
            <td class="status-badge">{{ $item->order->status->value }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 2rem;">Tidak ada transaksi pada periode ini.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <footer>
      <p>Indonesia Luxe Travel · partners@indonesialuxetravel.com</p>
      <p>Dokumen ini digenerate secara otomatis dan sah tanpa tanda tangan basah.</p>
    </footer>
  </div>
</body>

</html>