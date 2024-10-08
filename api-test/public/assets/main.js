

// var eventId = JSON.parse("{{ json_encode($event['id']) }}");
// var eventId = $event['id'];
console.log(eventId);

$(document).ready(function () {
    function fetchData() {
        $.ajax({
            url: '/event/' + eventId + '/details', // Assuming you have an endpoint for this
            method: 'GET',
            success: function (response) {
                // Update each section with the new data
                renderMatchOdds(response.eventDetails.match_odds, response.items);
                renderBookMakers(response.eventDetails, response.items);
                renderMarkets(response.eventDetails, response.items);
                renderFancy(response.eventDetails, response.items);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    // Fetch data initially
    fetchData();

    // Set interval to refresh every 3 seconds
    setInterval(fetchData, 500);


    // Match Odds SCRIPT


    function renderMatchOdds(matchOdds, items) {
        const tbodyElement = $('#match-odds-tbody');

        // Clear existing content
        tbodyElement.empty();

        // Check if matchOdds has runners
        if (!matchOdds || !matchOdds.runners || matchOdds.runners.length === 0) {
            tbodyElement.html('<tr><td colspan="7">No match odds available.</td></tr>');
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
                // console.log(`Row ${i}, Column ${j}: Primary = ${primaryValue}, Secondary = ${secondaryValue}`);

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
        activeBookMakers.forEach(function (bookMaker) {
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
                values.forEach(function (value) {
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
            const activeMarkets = eventDetails.markets.filter(function (market) {
                const excludedMarketTypes = ['MATCH_ODDS', 'BOOK_MAKER', 'FANCY'];
                return market.status === 1 && !excludedMarketTypes.includes(market.market_type_id);
            });

            // Loop through active markets
            activeMarkets.forEach(function (market) {
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
                    marketRunners.forEach(function (runner, i) {
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
                    marketRunners.forEach(function (runner, runnerIndex) {
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
            eventDetails.fancy.forEach(function (fancyItem) {
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

});

