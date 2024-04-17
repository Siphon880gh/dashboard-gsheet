console.log({payload: window.payload})

$(document).ready(function() {
    // Array of header names
    var headers = ['Name', 'Position', 'Office', 'Age', 'Start Date', 'Salary'];

    // Array of data records; each record is an array corresponding to a row
    var data = [
        ["Tiger Nixon", "System Architect", "Edinburgh", "61", "2011/04/25", "$320,800"],
        ["Garrett Winters", "Accountant", "Tokyo", "63", "2011/07/25", "$170,750"]
        // more records can be added here
    ];

    var headers = window.payload?.[0];
    var records = window.payload?.slice(1);
    if(!headers) headers = [];
    if(!records) records = [];
    var data = records;
    console.log({headers, data});
    debugger;

    // Create a 'columns' array for the DataTable configuration
    var columns = headers.map(function(header) {
        return {title: header}; // Maps each header to a column title
    });

    // Initialize the DataTable
    $('#data-table').DataTable({
        columns: columns,  // pass the dynamically created column configuration
        data: data   // pass the array of records
    });
});
