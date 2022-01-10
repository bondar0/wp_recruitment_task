window.onload = function () {
  var workersRow = document.querySelector("._workers-row");
  var ajaxLoadFieldPostId = workersRow.getAttribute("data-post-id");
  var ajaxLoadFieldOffset = workersRow.getAttribute("data-offset");
  var ajaxLoadFieldNonce = workersRow.getAttribute("data-nonce");
  var ajaxLoadAjaxUrl = workersRow.getAttribute("data-ajax-url");
  var ajaxLoadMore = workersRow.getAttribute("data-ajax-load-more");

  document
    .querySelector("._button")
    .addEventListener("click", ajax_load_show_more);

  function ajax_load_show_more() {
    jQuery.ajax({
      url: ajaxLoadAjaxUrl,
      method: "post",
      dataType: "json",
      data: {
        action: "ajax_load_more",
        post_id: ajaxLoadFieldPostId,
        offset: ajaxLoadFieldOffset,
        nonce: ajaxLoadFieldNonce,
      },
      beforeSend: function () {
        jQuery("._workers-loading").show();
      },
      success: function (response) {
        jQuery("._workers-row").append(response.content);
        jQuery("._workers-loading").hide();

        ajaxLoadFieldOffset = response.offset;

        if (!response.more) {
          jQuery("._button").css("display", "none");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      },
    });
  }
};
