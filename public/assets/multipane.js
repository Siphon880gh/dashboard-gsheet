// console.log({payload: window.payload})


function incremmentCountPanel() {
    if(typeof window.countPanel==="undefined") {
        window.countPanel = 0;
    } else {
        window.countPanel++;
    }
}

function renderIn(idSelector, payload) {

    var headers = payload?.[0];
    var records = payload?.slice(1);
    if(!headers) headers = [];
    if(!records) records = [];
    // var data = records;
    // console.log({headers, data});

    // Create a 'columns' array for the DataTable configuration
    var columns = headers.map(function(header) {
        return {title: header}; // Maps each header to a column title
    });

    // Initialize the DataTable
    $(idSelector).DataTable({
        columns: columns,  // pass the dynamically created column configuration
        data: records,   // pass the array of records
        responsive: true,
        fixedHeader: true,
        // ordering: false,
        fixedColumns: {
            left: 1
        },
    });
};
