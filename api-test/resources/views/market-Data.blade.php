<!DOCTYPE html>
<html>

<head>
    <title>Market Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-dark text-light">
    <h2 class="text-center mt-4">Market Data</h2>


    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-dark text-light">{{ $firstItem[14] }}</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="text-center">

                        <tr>
                            <th></th>
                            <th>Back</th>
                            <th>Lay</th>
                            <!-- <th>Suspended</th> -->
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>{{ $firstItem[19] }}</td>
                            <td>{{ $firstItem[24] }}</td>
                            <td>{{ $firstItem[26] }}</td>
                            <!-- <td>{{ $firstItem[29] }}</td> -->
                        </tr>
                        <tr>
                            <td>{{ $firstItem[32] }}</td>
                            <td>{{ $firstItem[37] }}</td>
                            <td>{{ $firstItem[39] }}</td>
                        </tr>
                        <tr>
                            <td>{{ $firstItem[45] }}</td>
                            <td>{{ $firstItem[50] }}</td>
                            <td>{{ $firstItem[52] }}</td>
                        </tr>
                        <tr>
                            <td>{{ $firstItem[58] }}</td>
                            <td>{{ $firstItem[63] }}</td>
                            <td>{{ $firstItem[65] }}</td>
                        </tr>
                        <tr>
                            <td>{{ $firstItem[71] }}</td>
                            <td>{{ $firstItem[76] }}</td>
                            <td>{{ $firstItem[78] }}</td>
                        </tr>
                        <tr>
                            <td>{{ $firstItem[84] }}</td>
                            <td>{{ $firstItem[89] }}</td>
                            <td>{{ $firstItem[91] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <h2 class="text-center mt-4">India v Bangladesh</h2>
        <div class="card  mb-4">
            <div class="card-header bg-dark text-light">MATCH ODDS</div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="text-center">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Back</th>
                            <th>Lay</th>
                            <th></th>
                            <th></th>
                            <!-- <th>Suspended</th> -->
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>{{ $items["item3"][19] }}</td>
                            <td>
                                <strong>{{ $items["item1"][14] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][15] }}</span>
                            </td>
                            <td>
                                <strong>{{ $items["item1"][12] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][13] }}</span>
                            </td>
                            <td class="bg-info">
                                <strong>{{ $items["item1"][10] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][11] }}</span>
                            </td>
                            <td class="bg-warning">
                                <strong>{{ $items["item1"][16] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][17] }}</span>
                            </td>
                            <td>
                                <strong>{{ $items["item1"][18] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][19] }}</span>
                            </td>
                            <td>
                                <strong>{{ $items["item1"][20] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][21] }}</span>
                            </td>
                        </tr>
                        <td>{{ $items["item3"][32] }}</td>
                        <td>
                            <strong>{{ $items["item1"][28] }}</strong>
                            <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][29] }}</span>
                        </td>
                        <td>
                            <strong>{{ $items["item1"][26] }}</strong>
                            <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][27] }}</span>
                        </td>
                        <td class="bg-info">
                            <strong>{{ $items["item1"][24] }}</strong>
                            <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][25] }}</span>
                        </td>
                        <td class="bg-warning">
                            <strong>{{ $items["item1"][30] }}</strong>
                            <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][31] }}</span>
                        </td>
                        <td>
                            <strong>{{ $items["item1"][32] }}</strong>
                            <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][33] }}</span>
                        </td>
                        <td>
                            <strong>{{ $items["item1"][34] }}</strong>
                            <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][35] }}</span>
                        </td>
                        </tr>
                        <tr>
                            <td>{{ $items["item3"][45] }}</td>
                            <td>
                                <strong>{{ $items["item1"][42] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][43] }}</span>
                            </td>
                            <td>
                                <strong>{{ $items["item1"][40] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][41] }}</span>
                            </td>
                            <td class="bg-info">
                                <strong>{{ $items["item1"][38] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][39] }}</span>
                            </td>
                            <td class="bg-warning">
                                <strong>{{ $items["item1"][44] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][45] }}</span>
                            </td>
                            <td>
                                <strong>{{ $items["item1"][46] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][47] }}</span>
                            </td>
                            <td>
                                <strong>{{ $items["item1"][48] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item1"][49] }}</span>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header bg-dark text-light">{{ $items['item2'][14]}}</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="text-center">

                        <tr>
                            <th></th>
                            <th>Back</th>
                            <th>Lay</th>
                            <!-- <th>Suspended</th> -->
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>{{ $items["item2"][19] }}</td>
                            <td class="bg-info">
                                <strong>{{ $items["item2"][24] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item2"][25] }}</span>
                            </td>
                            <td class="bg-warning">
                                <strong>{{ $items["item2"][26] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item2"][27] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ $items["item3"][32] }}</td>
                            <td class="bg-info">
                                <strong>{{ $items["item2"][37] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item2"][38] }}</span>
                            </td>
                            <td class="bg-warning">
                                <strong>{{ $items["item2"][39] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item2"][40] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ $items["item3"][45] }}</td>
                            <td class="bg-info">
                                <strong>{{ $items["item2"][50] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item2"][51] }}</span>
                            </td>
                            <td class="bg-warning">
                                <strong>{{ $items["item2"][52] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item2"][53] }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mt-4 mb-4">
            <div class="card-header bg-dark text-light">{{ $items['item5'][4]}}</div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="text-center">
                        <tr>
                            <th></th>
                            <th>NO</th>
                            <th>YES</th>
                            <th>Min-Max</th>
                            <!-- <th>Suspended</th> -->
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @for ($i = 5; $i <= 11; $i++)
                            <tr>
                            <td>{{ $items["item{$i}"][7] }}</td>
                            <td class="bg-info">
                                <strong>{{ $items["item{$i}"][20] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item{$i}"][19] }}</span>
                            </td>
                            <td class="bg-warning">
                                <strong>{{ $items["item{$i}"][18] }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $items["item{$i}"][17] }}</span>
                            </td>
                            <td>
                                {{ number_format($items["item{$i}"][8], 0) }} -
                                {{ $items["item{$i}"][9] >= 1000 ? number_format($items["item{$i}"][9] / 1000, 0) . 'k' : number_format($items["item{$i}"][9], 0) }}
                            </td>
                            </tr>
                            @endfor
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</body>

</html>