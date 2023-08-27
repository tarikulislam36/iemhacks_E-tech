// Initialize Quill.js
var quill = new Quill('#editor', {
    theme: 'snow'
});

// Function to save the content
function saveContent() {
    var content = quill.root.innerHTML;
    $.ajax({
        url: 'save.php',
        method: 'POST',
        data: { content: content },
        success: function (response) {
            // Handle the response as needed
        }
    });
}

// Save the content when text is modified
quill.on('text-change', function () {
    saveContent();
});

// Periodically save the content every 5 seconds
//setInterval(saveContent, 5000);

// Fetch and display the content from the database
function fetchContent() {
    $.ajax({
        url: 'fetch.php',
        method: 'GET',
        success: function (response) {
            quill.root.innerHTML = response;
        }
    });
}

// Call the fetchContent function on page load
fetchContent();


