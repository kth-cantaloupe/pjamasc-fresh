$(function() {
    $('#reviewForm').on('submit', function(event) {
        event.preventDefault();
        let comment = $('#comment').val();
        let rating = $('#select-stars').val();
        let product = $('#reviewProduct').val();
        let authorId = $('#reviewAuthorId').val();

        $.post("product.php?id=" + product, {
            rating: rating,
            comment: comment,
            product: product,
            author: authorId
        }, function (res) {
            if(res.status === 'success') {
                let date = getCurrentDate();
                let authorName = $('#reviewAuthorName').val();
                // create comment and add it to html dom
                $('#commentsContainer').append(
                    "<div class=\"comment\">" +
                    "                    <div class=\"comment-user\">" +
                    "                        <img class=\"comment-user-pic\" src=\"assets/images/profile-pic.png\" alt=\"User picture\">" +
                    "                        <img class=\"comment-stars\" src=\"assets/images/stars/" + rating + "-stars.png\" alt=\"stars\">" +
                    "                        <h3>" + authorName + "</h3>" +
                    "                        <h4>" + date + "</h4>" +
                    "                    </div>" +
                    "                    <p>" + comment + "</p>" +
                    "                    <hr>" +
                    "                </div>"
                );

                $('#select-stars').val("1");
                $('#comment').val("");
            } else {
                alert("Review could not be posted! Note that you cannot post two reviews for the same product.")
            }
        });
    });
});

function getCurrentDate() {
    var date = new Date($.now());
    return date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDay() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
}