const url = "https://www.googleapis.com/books/v1/volumes?q=";

function searchBook(q) {
    var request = $.get(url+q, function(data) {
        console.log("success");
        console.log(data);
        var item = data['items'][0]['volumeInfo'];
        var title = item['title'];
        console.log(title);
        var subtitle = item['subtitle'];
        console.log(subtitle);
        var author = item['authors'].join(', ');
        console.log(author);
        var publisher = item['publisher'];
        console.log(publisher);
        var description = item['description'];
        console.log(description);
        var isbn = item['industryIdentifiers'][0]['identifier'];
        console.log(isbn);
    })
        .done(function() {
            console.log("second success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("finished");
        });
}

searchBook('3960101031');