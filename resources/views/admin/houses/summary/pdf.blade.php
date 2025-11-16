<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $title }}</title>
  <style>
    @page { margin: 30px 40px; }

    body {
      font-family: 'Times New Roman', Times, serif;
      font-size: 12px;
      color: #000;
      text-align: justify;
    }

    /* === HEADER TABLE STYLE === */
    .header-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 6px;
      border: none;
    }

    .header-table td {
      vertical-align: middle;
      text-align: center;
      border: none;
    }

    .header-table .left,
    .header-table .right {
      width: 80px;
      border: none;
    }

    .header-table img {
      max-width: 65px;
      max-height: 65px;
      display: block;
      margin: 0 auto;
      object-fit: contain;
      border: none;
    }

    .header-title h1 {
      font-size: 16px;
      font-weight: bold;
      margin: 0;
      text-transform: uppercase;
    }

    .header-title h2 {
      font-size: 13px;
      font-weight: bold;
      margin: 3px 0 0 0;
      text-transform: uppercase;
    }

    .divider {
      border-top: 1px solid #000;
      margin: 4px 0 8px 0;
    }

    .meta-table {
        font-size: 12px;
        margin: 4px 0;
        display: flex;
        justify-content: space-between; 
        line-height: 1.2;
        border: none;
    }

    .meta-table td {
    border: none; 
    padding: 0;  
    font-size: 12px;
    line-height: 1.2;
}

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #000;
      padding: 6px 8px;
      text-align: center;
    }

    th {
      background-color: #f9f9f9;
      font-weight: bold;
    }

    td {
      vertical-align: middle;
    }

    .footer {
      text-align: center;
      font-size: 10px;
      margin-top: 20px;
      color: #555;
    }
  </style>
</head>
<body>

  {{-- HEADER --}}
  <table class="header-table">
    <tr>
      {{-- Left: School Logo --}}
      <td class="left">
        @if(!empty($schoolProfile->logo))
          <img src="{{ public_path('storage/' . $schoolProfile->logo) }}" alt="School Logo">
        @else
          <div style="height:65px;"></div>
        @endif
      </td>

      {{-- Center Title --}}
      <td class="header-title">
        <h1>{{ strtoupper($schoolProfile->name ?? 'HOGWARTS SCHOOL OF WIZARD AND WITCHCRAFT') }}</h1>
        <h2>{{ strtoupper($house->name) }} STUDENT SUMMARY {{ $startYear }}@if(!$singleYear) - {{ $endYear }}@endif</h2>
      </td>

      {{-- Right: House Logo --}}
      <td class="right">
        @if(!empty($house->logo))
          <img src="{{ public_path('storage/' . $house->logo) }}" alt="House Logo">
        @else
          <div style="height:65px;"></div>
        @endif
      </td>
    </tr>
  </table>

  <div class="divider"></div>

  {{-- META INFO --}}
  <div class="meta-table">
    <table>
    <tr>
        <td style="text-align:left;"><strong>Printed By:</strong> {{ auth('admin')->user()->name ?? 'Administrator' }}</td>
        <td style="text-align:right;"><strong>Generated On:</strong> {{ now()->format('d F Y, H:i') }}</td>
    </tr>
    </table>
  </div>

  <div class="divider"></div>

  {{-- TABLE --}}
  <table>
    <thead>
      <tr>
        <th style="width:40px;">No.</th>
        <th style="width:80px;">#ID</th>
        <th>Full Name</th>
        <th style="width:90px;">Year In</th>
        <th style="width:90px;">Year Out</th>
      </tr>
    </thead>
    <tbody>
    @forelse($students as $index => $student)
        @php
            $yearIn = $student->year ?? '-';
            $yearOut = is_numeric($yearIn) ? $yearIn + 6 : '-';
        @endphp
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $student->id }}</td>
            <td style="text-align: justify; padding-left: 8px;">{{ $student->name }}</td>
            <td>{{ $yearIn }}</td>
            <td>{{ $yearOut }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5">No student data available.</td>
        </tr>
    @endforelse
</tbody>

  </table>

  <div class="footer">
    Generated via Hogwarts Digital Archive
  </div>

</body>
</html>
