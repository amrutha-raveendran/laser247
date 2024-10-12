<!DOCTYPE html>
<html>

<head>
    <title>Event Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/bzip2.js') }}"></script>
</head>

<body class="bg-dark">

    <div class="container mt-4 ">
        <h4 class="text-white shadow">{{ $event['name'] }}</h4>
        <div id="html-content-section">
            @if(!empty($htmlContent))
            {!! $htmlContent !!}
            @endif
        </div>
        <!-- <div class="card">
            <div class="card-header">
                <h4 class="mb-0 text-center">Event Details</h4>
            </div>
            <div class="card-body">
                @if($event)
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Event Name:</strong> {{ $event['name'] }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Competition ID:</strong> {{ $event['competition_id'] }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Open Date:</strong> {{ \Carbon\Carbon::parse($event['open_date'])->format('Y-m-d H:i') }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>In Play:</strong> {{ $event['in_play'] ? 'Yes' : 'No' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Featured Event:</strong> {{ $event['featured_event'] ? 'Yes' : 'No' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>TV Provider:</strong> {{ $event['tv_provider'] }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Status:</strong> {{ $event['status'] }}</p>
                    </div>
                </div>
                @else
                <p>No event data found.</p>
                @endif
            </div>
        </div> -->
    </div>

    <div class="container">
        <!-- <div id="match-odds-section"> -->

        <!-- Match Odds Card -->
        @if(isset($eventDetails['match_odds']) && !is_null($eventDetails['match_odds']) && ($eventDetails['match_odds']['status'] == 1))
        <div class="card mb-4" id="match-odds-section">
            <div class="card-header bg-dark text-light">MATCH ODDS</div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="text-center">
                        <tr>
                            <th></th>
                            <th>Back</th>
                            <th></th>
                            <th></th>
                            <th>Lay</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>




                    <tbody class="text-center" id="match-odds-tbody">
                        <?php
                        $startItem3 = 19;
                        $startItem1 = 10;
                        $item3Increment = 13;
                        $item1Increment = 14;
                        $columnsPerRow = 6;
                        $totalRows = count($eventDetails['match_odds']['runners']);
                        $selectedMarketId = $eventDetails['match_odds']['market_id'];

                        $matchedItem = null;
                        $excludedTypes = ['BOOK_MAKER', 'FANCY'];

                        foreach ($items as $itemKey => $itemArray) {
                            if (is_array($itemArray) && in_array($selectedMarketId, $itemArray)) {

                                if (!array_intersect($excludedTypes, $itemArray)) {
                                    $matchedItem = $itemArray;
                                    break;
                                }
                            }
                        }

                        $rows = [];
                        for ($i = 0; $i < $totalRows; $i++) {
                            $row = [
                                "item1" => [] // Only keep item1 for dynamic values
                            ];

                            // Calculate item1 values for the row dynamically (12 values per row)
                            for ($j = 0; $j < $columnsPerRow * 2; $j++) {
                                $row["item1"][] = $startItem1 + ($i * $item1Increment) + $j;
                            }

                            $rows[] = $row;
                        }
                        ?>
                        @foreach($rows as $row)
                        <tr>
                            <td>
                                @if(isset($eventDetails['match_odds']['runners'][$loop->index]['name']))
                                <strong>{{ $eventDetails['match_odds']['runners'][$loop->index]['name'] }}</strong>
                                @endif
                            </td>
                            @for ($i = 0; $i < count($row['item1']); $i +=2)
                                @if($matchedItem !==null)
                                <td>
                                <strong>{{ $matchedItem[$row['item1'][$i]] ?? '' }}</strong>
                                <span style="font-size: 0.7em; display: block; margin-top: 5px;">
                                    {{ $matchedItem[$row['item1'][$i + 1]] ?? '' }}
                                </span>
                                </td>
                                @else
                                <td>-</td>
                                @endif
                                @endfor
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        <!-- </div> -->

        <div id="book-makers-table">
            <!-- BookMakers Data -->
            @if(isset($eventDetails['book_makers']) && is_array($eventDetails['book_makers']) && count($eventDetails['book_makers']) > 0)
            <?php
            // Filter book makers to include only those with status 1
            $activeBookMakers = array_filter($eventDetails['book_makers'], function ($bookMaker) {
                return isset($bookMaker['status']) && $bookMaker['status'] == 1;
            });
            ?>

            @foreach ($activeBookMakers as $bookMaker)
            <?php
            $marketId = $bookMaker['market_id'];
            $bookMakerOdds = $bookMaker['book_maker_odds'];

            // Initialize an array to store the values for this market_id
            $values = [];

            // Check for matching market_id in items
            foreach ($items as $itemKey => $itemArray2) {
                if (is_array($itemArray2) && in_array($marketId, $itemArray2)) {
                    // If market_id matches, retrieve the values based on your logic
                    $startIndex = 19; // Starting index for the items
                    $rowCount = count($itemArray2);

                    // Loop through the indices based on your defined logic
                    for ($i = 0; $i < $rowCount; $i++) {
                        $currentRowIndex = $startIndex + ($i * 13);
                        $valueBackIndex = $currentRowIndex + 5;
                        $valueBackExtra = $currentRowIndex + 6;
                        $valueLayIndex = $currentRowIndex + 7;
                        $valueLayExtra = $currentRowIndex + 8;

                        // Check if these indices exist in the items array
                        if (isset($itemArray2[$currentRowIndex], $itemArray2[$valueBackIndex], $itemArray2[$valueLayIndex], $itemArray2[$valueBackExtra], $itemArray2[$valueLayExtra])) {
                            $values[] = [
                                'name' => $itemArray2[$currentRowIndex],
                                'back_value' => $itemArray2[$valueBackIndex] ?? '',
                                'lay_value' => $itemArray2[$valueLayIndex] ?? '',
                                'back_extra' => $itemArray2[$valueBackExtra] ?? '',
                                'lay_extra' => $itemArray2[$valueLayExtra] ?? ''
                            ];
                        }
                    }
                    break; // Exit the loop once you've found the market_id



                }
            }
            // dd($values);
            ?>
            <!-- Display the card for the book maker -->
            <div class="card mt-4">
                <div class="card-header bg-dark text-light">{{ $bookMaker['title'] }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="text-center">
                            <tr>
                                <th></th>
                                <th>Back</th>
                                <th>Lay</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($values as $value)
                            <tr>
                                <td>{{ $value['name'] }}</td>
                                <td class="bg-info">
                                    <strong>{{ $value['back_value'] }}</strong>
                                    <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $value['back_extra'] ?? '' }}</span>
                                </td>
                                <td class="bg-warning">
                                    <strong>{{ $value['lay_value'] }}</strong>
                                    <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $value['lay_extra'] ?? '' }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div id="markets-section">
            <!-- Markets Data -->
            @if(isset($eventDetails['markets']) && is_array($eventDetails['markets']) && count($eventDetails['markets']) > 0)
            <?php
            $startItem3 = 19;
            $startItem1 = 10;
            $item3Increment = 13;
            $item1Increment = 14;
            $columnsPerRow = 6;

            // Filter active markets
            $activeMarkets = array_filter($eventDetails['markets'], function ($market) {
                $excludedMarketTypes = ['MATCH_ODDS', 'BOOK_MAKER', 'FANCY'];
                return isset($market['status'], $market['market_type_id'])
                    && $market['status'] == 1
                    && !in_array($market['market_type_id'], $excludedMarketTypes);
            });

            // Initialize matchedItem as null
            $matchedItem = null;

            // Loop through active markets to find matching items
            foreach ($activeMarkets as $marketIndex => $market) {
                foreach ($items as $itemKey => $itemArray) {
                    // Ensure we are checking each market's ID against the items
                    if (is_array($itemArray) && in_array($market['market_id'], $itemArray)) {
                        $matchedItem = $itemArray;

                        break;
                    }
                }
                $marketRunners = $market['runners'];
                // dd($marketRunners);
                $rows = [];
                if (!empty($marketRunners)) {
                    for ($i = 0; $i < count($marketRunners); $i++) {
                        $row = [
                            "item1" => []
                        ];

                        // Calculate item1 values for the row dynamically (12 values per row)
                        for ($j = 0; $j < $columnsPerRow * 2; $j++) {
                            $row["item1"][] = $startItem1 + ($i * $item1Increment) + $j;
                        }

                        $rows[] = $row;
                    }
                }

            ?>
                <div class="card mt-4">
                    <div class="card-header bg-dark text-light">{{ $market['market_name'] }}</div>
                    <div class="card-body">
                        <table class="table table-hover table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th></th>
                                    <th>Back</th>
                                    <th></th>
                                    <th></th>
                                    <th>Lay</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if (!empty($marketRunners))
                                @foreach($marketRunners as $runnerIndex => $runner)
                                <tr>
                                    <td>{{ $runner['name'] }}</td>

                                    @if(isset($rows[$runnerIndex]))
                                    @for ($i = 0; $i < count($rows[$runnerIndex]['item1']); $i +=2)
                                        <td>
                                        @if($matchedItem !== null)
                                        <strong>{{ $matchedItem[$rows[$runnerIndex]['item1'][$i]] ?? '' }}</strong>
                                        <span style="font-size: 0.7em; display: block; margin-top: 5px;">
                                            {{ $matchedItem[$rows[$runnerIndex]['item1'][$i + 1]] ?? '' }}
                                        </span>
                                        @else
                                        -
                                        @endif
                                        </td>
                                        @endfor
                                        @else
                                        <!-- If there are no rows for the current runner, show 6 empty cells -->
                                        @for ($i = 0; $i < 6; $i++)
                                            <td>-</td>
                                            @endfor
                                            @endif
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>No runners available</td>
                                </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            <?php
            }
            ?>
            @endif
        </div>

        <div id="fancy-section">
            <!-- Fancy Card -->
            @if(isset($eventDetails['fancy']) && is_array($eventDetails['fancy']) && count($eventDetails['fancy']) > 0)

            <div class="card mt-4 mb-4">
                @if (isset($eventDetails['fancy'][0]['market_type_id']))
                <div class="card-header bg-dark text-light">{{ $eventDetails['fancy'][0]['market_type_id'] }}</div>
                @endif

                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead class="text-center">
                            <tr>
                                <th></th>
                                <th>NO</th>
                                <th>YES</th>
                                <th>Min-Max</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($eventDetails['fancy'] as $fancyItem)
                            <?php
                            $marketId = $fancyItem['market_id'];

                            $matchedItem1 = null;

                            // Search for the matching market_id in items[]
                            foreach ($items as $itemKey => $itemArray) {
                                if (is_array($itemArray) && in_array($marketId, $itemArray)) {
                                    $matchedItem1 = $items[$itemKey];
                                    break;
                                }
                            }
                            // dd($matchedItem1);
                            ?>

                            @if ($matchedItem1 !== null)
                            <tr>
                                <td>{{ $matchedItem1[7] ?? '' }}</td>
                                <td class="bg-info">
                                    <strong>{{ $matchedItem1[20] ?? '' }}</strong>
                                    <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $matchedItem1[19] ?? '' }}</span>
                                </td>
                                <td class="bg-warning">
                                    <strong>{{ $matchedItem1[18] ?? '' }}</strong>
                                    <span style="font-size: 0.7em; display: block; margin-top: 5px;">{{ $matchedItem1[17] ?? '' }}</span>
                                </td>
                                <td>
                                    {{ number_format($matchedItem1[8], 0) }} -
                                    {{ $matchedItem1[9] >= 1000 ? number_format($matchedItem1[9] / 1000, 0) . 'k' : number_format($matchedItem1[9], 0) }}
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>

    </div>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>


    <script>
        // Pusher.logToConsole = true;


        var eventId = JSON.parse("{{ json_encode($event['id']) }}");

        function renderMatchOdds(matchOdds, items) {

            const tbodyElement = $('#match-odds-tbody');


            // Clear existing content
            tbodyElement.empty();

            // Check if matchOdds exists and has runners
            if (!matchOdds || matchOdds.status !== 1 || !matchOdds.runners || matchOdds.runners.length === 0) {
                // Show a message when match odds are not available

                return;
            }

            let tbodyHtml = '';
            const totalRows = matchOdds.runners.length;
            const selectedMarketId = matchOdds.market_id;

            let matchedItem = null;
            const excludedTypes = ['BOOK_MAKER', 'FANCY'];

            // Find matched item from items
            for (const itemKey in items) {
                const itemArray = items[itemKey];
                if (Array.isArray(itemArray) && itemArray.includes(selectedMarketId) &&
                    !arrayIntersect(itemArray, excludedTypes)) {
                    matchedItem = itemArray;
                    break;
                }
            }

            // If no matching items are found, show a fallback message
            if (!matchedItem) {
                // tbodyElement.html('<tr><td colspan="7">No matched items found for the selected market.</td></tr>');
                return;
            }

            // Dynamic row generation
            const startItem1 = 10; // Starting index for primary values
            const item1Increment = 14; // Increment for moving to the next row
            const columnsPerRow = 6; // Number of columns per row

            for (let i = 0; i < totalRows; i++) {
                tbodyHtml += '<tr>';

                // Adding the runner name
                const runnerName = matchOdds.runners[i]?.name || '';
                tbodyHtml += `<td><strong>${runnerName}</strong></td>`;

                // Calculate primary and secondary values for the row dynamically
                for (let j = 0; j < columnsPerRow; j++) {
                    const itemIndex = startItem1 + (i * item1Increment) + (j * 2); // Calculate index for primary
                    const primaryValue = matchedItem[itemIndex] || ''; // Primary value from matchedItem
                    const secondaryValue = matchedItem[itemIndex + 1] || ''; // Next item for secondary value

                    tbodyHtml += `
<td>
<strong>${primaryValue}</strong>
<span style="font-size: 0.7em; display: block; margin-top: 5px;">
    ${secondaryValue}
</span>
</td>`;
                }

                tbodyHtml += '</tr>';
            }

            // Update the <tbody> with the constructed HTML
            tbodyElement.html(tbodyHtml);
        }

        function arrayIntersect(arr1, arr2) {
            return arr1.some(item => arr2.includes(item));
        }


        // Book Makers SCRIPT

        function renderBookMakers(eventDetails, items) {
            const tbodyElement1 = $('#book-makers-table'); // This should be the tbody element

            // Clear existing content
            tbodyElement1.empty();


            // Check if there are any bookmakers
            if (!eventDetails.book_makers || !Array.isArray(eventDetails.book_makers) || eventDetails.book_makers.length === 0) {
                tbodyElement1.append('<tr><td colspan="3">No active bookmakers available.</td></tr>'); // Message for no bookmakers
                return; // Exit the function
            }
            let html = '';

            // Filter book makers to include only those with status 1
            const activeBookMakers = eventDetails.book_makers.filter(bookMaker => bookMaker.status === 1);

            // Check if there are any active book makers
            if (activeBookMakers.length === 0) {
                tbodyElement1.append('<tr><td colspan="3">No active bookmakers available.</td></tr>');
                return; // Exit the function
            }

            // Loop through each active bookmaker
            activeBookMakers.forEach(function(bookMaker) {
                const marketId = bookMaker.market_id;

                // Initialize an array to store the values for this market_id
                const values = [];

                // Check if items is an object
                if (items && typeof items === 'object') {
                    // Loop through the properties of the items object
                    for (let key in items) {
                        const itemArray = items[key];

                        // Check if the itemArray is an array and if it contains the marketId
                        if (Array.isArray(itemArray) && itemArray.includes(marketId)) {
                            const startIndex = 19; // Starting index for the items
                            const rowCount = itemArray.length;

                            // Loop through the indices based on your defined logic
                            for (let i = 0; i < rowCount; i++) {
                                const currentRowIndex = startIndex + (i * 13);
                                const valueBackIndex = currentRowIndex + 5;
                                const valueBackExtra = currentRowIndex + 6;
                                const valueLayIndex = currentRowIndex + 7;
                                const valueLayExtra = currentRowIndex + 8;

                                // Check if these indices exist in the itemArray
                                if (
                                    itemArray[currentRowIndex] !== undefined &&
                                    itemArray[valueBackIndex] !== undefined &&
                                    itemArray[valueLayIndex] !== undefined &&
                                    itemArray[valueBackExtra] !== undefined &&
                                    itemArray[valueLayExtra] !== undefined
                                ) {
                                    values.push({
                                        name: itemArray[currentRowIndex],
                                        back_value: itemArray[valueBackIndex] || '',
                                        lay_value: itemArray[valueLayIndex] || '',
                                        back_extra: itemArray[valueBackExtra] || '',
                                        lay_extra: itemArray[valueLayExtra] || ''
                                    });
                                }
                            }
                            break; // Exit the loop once you've found the market_id
                        }
                    }
                } else {
                    console.warn('Items is not a valid object:', items); // Log a warning if items is not valid
                }

                // Create card structure for each bookmaker
                html += `
<div class="card mt-4">
<div class="card-header bg-dark text-light">${bookMaker.title}</div>
<div class="card-body">
<table class="table table-hover">
    <thead class="text-center">
        <tr>
            <th></th>
            <th>Back</th>
            <th>Lay</th>
        </tr>
    </thead>
    <tbody class="text-center">`;

                // Check if the bookmaker has values
                if (values.length > 0) {
                    // Loop through the values associated with the bookmaker
                    values.forEach(function(value) {
                        html += `
<tr>
    <td>${value.name}</td>
    <td class="bg-info">
        <strong>${value.back_value}</strong>
        <span style="font-size: 0.7em; display: block; margin-top: 5px;">${value.back_extra || ''}</span>
    </td>
    <td class="bg-warning">
        <strong>${value.lay_value}</strong>
        <span style="font-size: 0.7em; display: block; margin-top: 5px;">${value.lay_extra || ''}</span>
    </td>
</tr>`;
                    });
                } else {
                    // Handle case where there are no values for this bookmaker
                    html += '<tr><td colspan="3">No odds available for this bookmaker.</td></tr>';
                }

                // Close the table and card structure
                html += `
    </tbody>
</table>
</div>
</div>`;
            });

            // Append the constructed HTML to the tbody element
            tbodyElement1.append(html); // Append the constructed HTML
        }



        // Market Script

        function renderMarkets(eventDetails, items) {
            const marketsSection = $('#markets-section');
            // Clear existing content
            marketsSection.empty();
            let html = '';

            // Check if eventDetails has markets and is an array
            if (eventDetails.markets && Array.isArray(eventDetails.markets) && eventDetails.markets.length > 0) {
                // Filter active markets
                const activeMarkets = eventDetails.markets.filter(function(market) {
                    const excludedMarketTypes = ['MATCH_ODDS', 'BOOK_MAKER', 'FANCY'];
                    return market.status === 1 && !excludedMarketTypes.includes(market.market_type_id);
                });

                // Loop through active markets
                activeMarkets.forEach(function(market) {
                    let matchedItem = null;

                    // Find matching item for the market
                    for (let itemKey in items) {
                        const itemArray = items[itemKey];
                        if (Array.isArray(itemArray) && itemArray.includes(market.market_id)) {
                            matchedItem = itemArray;
                            break; // Stop searching once a match is found
                        }
                    }

                    const marketRunners = market.runners || [];
                    let rows = [];

                    // Build rows structure for market runners
                    const columnsPerRow = 6;
                    const startItem1 = 10;
                    const item1Increment = 14;

                    if (marketRunners.length > 0) {
                        marketRunners.forEach(function(runner, i) {
                            let row = {
                                item1: []
                            };

                            // Calculate item1 values for each runner (12 values per row)
                            for (let j = 0; j < columnsPerRow * 2; j++) {
                                row["item1"].push(startItem1 + (i * item1Increment) + j);
                            }

                            rows.push(row);
                        });
                    }

                    // Create card structure for each market
                    html += `
<div class="card mt-4">
    <div class="card-header bg-dark text-light">${market.market_name}</div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead class="text-center">
                <tr>
                    <th></th>
                    <th>Back</th>
                    <th></th>
                    <th></th>
                    <th>Lay</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-center">`;

                    // Loop through market runners
                    if (marketRunners.length > 0) {
                        marketRunners.forEach(function(runner, runnerIndex) {
                            html += `<tr>
        <td>${runner.name}</td>`;

                            if (rows[runnerIndex]) {
                                // Render item1 values dynamically
                                for (let i = 0; i < rows[runnerIndex].item1.length; i += 2) {
                                    html += `<td>`;
                                    if (matchedItem !== null) {
                                        html += `<strong>${matchedItem[rows[runnerIndex].item1[i]] ?? ''}</strong>
                    <span style="font-size: 0.7em; display: block; margin-top: 5px;">
                        ${matchedItem[rows[runnerIndex].item1[i + 1]] ?? ''}
                    </span>`;
                                    } else {
                                        html += `-`;
                                    }
                                    html += `</td>`;
                                }
                            } else {
                                // If no rows for the current runner, show 6 empty cells
                                for (let i = 0; i < 6; i++) {
                                    html += `<td>-</td>`;
                                }
                            }

                            html += `</tr>`;
                        });
                    } else {
                        // No runners available for the market
                        html += `<tr><td colspan="6">No runners available</td></tr>`;
                    }

                    // Close the table and card structure
                    html += `
            </tbody>
        </table>
    </div>
</div>`;
                });

                marketsSection.html(html); // Append generated HTML to the markets section
            } else {
                html += `<div>No markets available</div>`;
                marketsSection.html(html);
            }
        }



        // Fancy SCRIPT

        function renderFancy(eventDetails, items) {
            const fancySection = $('#fancy-section');
            // Clear existing content
            fancySection.empty();
            let html = '';

            // Check if eventDetails has fancy and is an array
            if (eventDetails.fancy && Array.isArray(eventDetails.fancy) && eventDetails.fancy.length > 0) {
                html += `<div class="card mt-4 mb-4">`;

                // Add market_type_id header if it exists
                if (eventDetails.fancy[0].market_type_id) {
                    html += `<div class="card-header bg-dark text-light">${eventDetails.fancy[0].market_type_id}</div>`;
                }

                html += `<div class="card-body">
    <table class="table table-striped table-hover">
        <thead class="text-center">
            <tr>
                <th></th>
                <th>NO</th>
                <th>YES</th>
                <th>Min-Max</th>
            </tr>
        </thead>
        <tbody class="text-center">`;

                // Loop through each fancy item
                eventDetails.fancy.forEach(function(fancyItem) {
                    const marketId = fancyItem.market_id;

                    // Check if fancyItem status is 1
                    if (fancyItem.status === 1) { // Add the condition here
                        let matchedItem1 = null;

                        // Search for the matching market_id in items
                        for (let itemKey in items) {
                            const itemArray = items[itemKey];

                            if (Array.isArray(itemArray) && itemArray.includes(marketId)) {
                                matchedItem1 = itemArray;
                                break; // Stop searching once we find a match
                            }
                        }
                        // console.log('Matched Item:', matchedItem1);
                        // Render the row if we found a matching item
                        if (matchedItem1) {
                            html += `
    <tr>
        <td>${matchedItem1[7] ?? ''}</td>
        <td class="bg-info">
            <strong>${matchedItem1[20] ?? ''}</strong>
            <span style="font-size: 0.7em; display: block; margin-top: 5px;">${matchedItem1[19] ?? ''}</span>
        </td>
        <td class="bg-warning">
            <strong>${matchedItem1[18] ?? ''}</strong>
            <span style="font-size: 0.7em; display: block; margin-top: 5px;">${matchedItem1[17] ?? ''}</span>
        </td>
        <td>
            ${number_format(matchedItem1[8], 0)} - 
            ${matchedItem1[9] >= 1000 ? number_format(matchedItem1[9] / 1000, 0) + 'k' : number_format(matchedItem1[9], 0)}
        </td>
    </tr>`;
                        }
                    }
                });

                html += `</tbody></table></div></div>`;
            } else {
                html += '<div>No fancy items available.</div>'; // Handle case when no fancy items exist
            }

            // Append the constructed HTML to the fancy section
            fancySection.html(html); // Update the fancy section with the generated HTML
        }

        // Helper function for formatting numbers (if needed)
        function number_format(number, decimals) {
            return parseFloat(number).toFixed(decimals);
        }

        // setInterval(function() {
        //     $.ajax({
        //         url: '/event/' + eventId + '/details',
        //         method: 'GET',
        //         async: true,
        //         cache: false,
        //         // success: function(response) {
        //         //     console.log(response);
        //         //     // Handle the response data, e.g., update the UI

        //         // }
        //     });
        // }, 3000);


        // console.log(eventId);
        $(document).ready(function() {
            // $(window).on('load', function() {

            var pusher = new Pusher('d1e5b61f987c9dd29add', {
                cluster: 'ap2'
            });
            var channelName = 'event_Handle.' + eventId;
            var channel = pusher.subscribe(channelName);
            channel.bind('event.pushed', function(data) {

                let binaryString = atob(data.data);

                // Step 2: Convert binary string to a Uint8Array (pako expects this format)
                let charData = binaryString.split('').map(function(c) {
                    return c.charCodeAt(0);
                });

                let byteArray = new Uint8Array(charData);
                let decompressedData = bzip2.simple(bzip2.array(byteArray));
                // let decompressedData = pako.inflate(byteArray, {
                //     to: 'string'
                // });
                // console.log(decompressedData);
                const decompressedText = new TextDecoder().decode(decompressedData);
                let eventData = JSON.parse(decompressedText);
                // console.log(eventData);
                var event = eventData.event;
                var items = eventData.items;
                var eventDetails = eventData.eventDetails;
                // var marketIds = eventData.marketIds;
                var currentEventId = event['id'];
                console.log('Event:', event);
                // console.log('Items:', items);
                // console.log('Event Details:', eventDetails);
                // console.log('Market IDs:', marketIds); // Log the data to console
                // Display the data on the webpage
                // const enquiryDisplay = document.getElementById('enquiry-display');
                if (currentEventId === eventId) {
                    renderMatchOdds(eventDetails.match_odds, items);
                    renderBookMakers(eventDetails, items);
                    renderMarkets(eventDetails, items);
                    renderFancy(eventDetails, items);
                } else {
                    console.log('Event ID does not match. No rendering performed.');
                }
            });

        });
    </script>




</body>

</html>