<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
        }
    </style>
</head>
<body>
    <h2>Laporan Keuangan Mata Angin Outdoor</h2>
    <hr>
    <p>
        Total Pemasukan :
        Rp {{ number_format($totalPemasukan) }}
    </p>
    <p>
        Total Pengeluaran :
        Rp {{ number_format($totalPengeluaran) }}
    </p>
    <p>
        Saldo Bersih :
        Rp {{ number_format($saldoBersih) }}
    </p>

    <h3>Data Pemasukan</h3>
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>

        @foreach($pemasukan as $item)
        <tr>
            <td>{{ $item->tanggal }}</td>
            <td>
                Rp {{ number_format($item->total_pemasukan) }}
            </td>
        </tr>
        @endforeach
    </table>
    <br>

    <h3>Data Pengeluaran</h3>
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Nominal</th>
        </tr>

        @foreach($pengeluaran as $item)
        <tr>
            <td>{{ $item->tanggal }}</td>
            <td>
                Rp {{ number_format($item->nominal) }}
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
