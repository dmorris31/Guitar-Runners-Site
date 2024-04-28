$(document).ready(function () {
    loadTopics();

    $("#topicForm").submit(function (event) {
        event.preventDefault();
        $.post("saveDiscussion.php", $(this).serialize(), function (data) {
            alert(data);
            if (data.startsWith("New topic created successfully")) {
                loadTopics();
            }
        });
    });
});

function loadTopics() {
    $.get("loadTopics.php", function (data) {
        $("#forum").html(data);
    });
}

function postComment(button) {
    const commentForm = $(button).parent();
    const postDiv = $(commentForm).parent();
    const topicId = $(postDiv).find('input[name="topic_id"]').val();
    const name = $(commentForm).find('.comment-name').val();
    const comment = $(commentForm).find('.comment-text').val();

    $.post("saveDiscussion.php", { topic_id: topicId, name: name, comment: comment }, function (data) {
        alert(data);
        if (data.startsWith("New comment created successfully")) {
            loadTopics(); // Reload topics only after posting a new comment
        }
    });
}

